<?php
include("../bd/conexao.php");
header('Content-Type: application/json');

// Apenas para testes em 2027
$ano = 2027;

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

// Função para obter weekday (1=Segunda, ..., 7=Domingo)
function getDbWeekday($timestamp) {
    $php_w = date('w', $timestamp); 
    return $php_w == 0 ? 7 : $php_w;
}

sqlsrv_begin_transaction($conn);
$inserted = 0;
$errors = [];

try {
    // Apaga eventos de bloqueio gerados anteriormente para 2027 (apenas eventos deste script)
    $delSql = "DELETE FROM events WHERE id_tratamento = 9999 AND title = 'Horário não disponível' AND start_event >= '2027-01-01 00:00:00' AND start_event < '2028-01-01 00:00:00'";
    $delRes = sqlsrv_query($conn, $delSql);
    if ($delRes === false) {
        throw new Exception('Falha ao apagar eventos anteriores: ' . print_r(sqlsrv_errors(), true));
    }

    $start = strtotime("$ano-01-01");
    $end = strtotime("$ano-12-31");
    for ($data = $start; $data <= $end; $data += 86400) {
        $dia = date('Y-m-d', $data);
        $weekday = getDbWeekday($data);

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