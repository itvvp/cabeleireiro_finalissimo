<?php
include("../bd/conexao.php");
header('Content-Type: application/json');

include_once __DIR__ . '/../timerSetter.php'; // <--- novo include

// obter valores a partir do timerSetter
$time_emulator = ts_get_time_emulator();
$emulatedNow = ts_get_emulated_now();
$forceYearOnly = ts_force_year_only_from_emulator($time_emulator);
$deleteStartExpr = ts_get_delete_start_expr();

// manter compatibilidade: $ano usado posteriormente para limite de geração
$ano = isset($_REQUEST['ano']) ? intval($_REQUEST['ano']) : (int)$emulatedNow->format('Y') + 1;
$anoInicio = $ano;
$anoFim = $ano + 2;

// Buscar cabeleireiras
$cabeleireiras = [];
$sql = "SELECT id FROM terapeutas";
$stmt = sqlsrv_query($conn, $sql);
if ($stmt === false) {
    echo json_encode(['success' => false, 'error' => 'Erro ao buscar cabeleireiras']);
    exit;
}
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $cabeleireiras[] = $row['id'];
}
if (empty($cabeleireiras)) {
    echo json_encode(['success' => false, 'error' => 'Nenhuma cabeleireira encontrada']);
    exit;
}

// Buscar horários de funcionamento
$horarios = [];
$sql = "SELECT weekday, is_enable, CONVERT(VARCHAR(5), start_time, 108) AS start_time, CONVERT(VARCHAR(5), end_time, 108) AS end_time FROM horarios_funcionamento";
$stmt = sqlsrv_query($conn, $sql);
if ($stmt === false) {
    echo json_encode(['success' => false, 'error' => 'Erro ao buscar horários']);
    exit;
}
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    // weekday: 1=Segunda, ..., 7=Domingo
    $horarios[$row['weekday']] = [
        'is_enable' => (int)$row['is_enable'],
        'start' => $row['start_time'],
        'end' => $row['end_time']
    ];
}

sqlsrv_begin_transaction($conn);
$inserted = 0;
$errors = [];

try {
    // determinar início da deleção / "now" emulado
    if ($time_emulator === '') {
        $deleteStartExpr = 'GETDATE()';
        $emulatedNow = new DateTimeImmutable('now');
        $forceYearOnly = false;
    } elseif (preg_match('/^\d{4}$/', $time_emulator)) {
        $deleteStartExpr = "'{$time_emulator}-01-01 00:00:00'";
        $emulatedNow = new DateTimeImmutable("{$time_emulator}-01-01");
        $forceYearOnly = true;
    } else {
        // emulador é uma data/hora específica -> usar como now
        $deleteStartExpr = "'{$time_emulator}'";
        $emulatedNow = new DateTimeImmutable($time_emulator);
        $forceYearOnly = false;
    }

    // Limite superior para deleção: se $ano >= 2029 usar $ano-01-01 00:00:00, senão até 2028
    $endBoundary = ($ano >= 2029) ? "$ano-01-01 00:00:00" : "2028-01-01 00:00:00";

    // Apaga eventos gerados anteriormente a partir do "now" (ou emulação) até o limite
    $delSql = "DELETE FROM events WHERE id_tratamento = 9999 AND title = 'Horário não disponível' AND start_event >= $deleteStartExpr AND start_event < ?";
    $delRes = sqlsrv_query($conn, $delSql, [$endBoundary]);
    if ($delRes === false) {
        throw new Exception('Falha ao apagar eventos anteriores: ' . print_r(sqlsrv_errors(), true));
    }

    // Usar DateTimeImmutable para iterar por dias (evita problemas com DST/86400)
    if ($forceYearOnly) {
        // iniciar e terminar apenas no ano emulado
        $startDate = new DateTimeImmutable($emulatedNow->format('Y-01-01'));
        $endDate = new DateTimeImmutable($emulatedNow->format('Y-12-31'));
    } else {
        // iniciar a partir do "now" emulado ou $ano-01-01 (o que for maior)
        $anoStart = new DateTimeImmutable("$ano-01-01");
        $startDate = ($emulatedNow > $anoStart) ? $emulatedNow : $anoStart;
        $endDate = new DateTimeImmutable("$anoFim-12-31");
    }

    for ($dt = $startDate; $dt <= $endDate; $dt = $dt->modify('+1 day')) {
        $dia = $dt->format('Y-m-d');

        $phpN = (int)$dt->format('N');
        $weekday = ($phpN % 7); 

        $h = isset($horarios[$weekday]) ? $horarios[$weekday] : null;
        $bloqueios = [];

        if (!$h || $h['is_enable'] == 0) {
            // Bloquear o dia todo
            $bloqueios[] = ['start' => '00:00:00', 'end' => '23:59:59'];
        } else {
            // Bloquear antes do início e depois do fim
            if (!empty($h['start']) && $h['start'] !== '00:00') {
                $bloqueios[] = ['start' => '00:00:00', 'end' => $h['start'] . ':00'];
            }
            if (!empty($h['end'] ) && $h['end'] !== '23:59') {
                $bloqueios[] = ['start' => $h['end'] . ':00', 'end' => '23:59:59'];
            }
        }

        foreach ($bloqueios as $b) {
            foreach ($cabeleireiras as $cab) {
                $sql = "INSERT INTO events (title, start_event, end_event, color, text_color, id_tratamento, cabeleireira) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $params = [
                    'Horário não disponível',
                    $dia . ' ' . $b['start'],
                    $dia . ' ' . $b['end'],
                    '#33333373',
                    '#ffffff71',
                    9999,
                    $cab
                ];
                $res = sqlsrv_query($conn, $sql, $params);
                if ($res === false) {
                    $errors[] = sqlsrv_errors();
                } else {
                    $inserted++;
                }
            }
        }
    }

    if (count($errors) > 0) {
        sqlsrv_rollback($conn);
        echo json_encode(['success' => false, 'error' => $errors]);
    } else {
        sqlsrv_commit($conn);
        echo json_encode(['success' => true, 'inserted' => $inserted]);
    }
} catch (Exception $e) {
    sqlsrv_rollback($conn);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>