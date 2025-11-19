<?php
header('Content-Type: application/json; charset=utf-8');

try {
    require_once __DIR__ . '/../bd/conexao.php';

    // Recebe days via POST (FormData): days[0][weekday], days[0][enabled], days[0][start], days[0][end], ...
    $days = $_POST['days'] ?? null;
    if (!is_array($days)) throw new Exception('Dados inválidos: days ausente.');

    // Normaliza e prepara linhas para gravar.
    $toInsert = [];
    foreach ($days as $entry) {
        // aceitar tanto índices numéricos como associativos
        $weekday_api = isset($entry['weekday']) ? (int)$entry['weekday'] : (isset($entry[ 'weekday']) ? (int)$entry['weekday'] : null);
        // novo padrão API: 1 = Domingo, 2 = Segunda, ... 7 = Sábado
        if ($weekday_api === null) continue;

        // converter para BD (BD espera 1 = Segunda, ..., 7 = Domingo)
        $weekday_db = ($weekday_api === 1) ? 7 : ($weekday_api - 1);

        $is_enable = isset($entry['enabled']) ? ((int)$entry['enabled'] ? 1 : 0) : 0;
        $start = isset($entry['start']) && $entry['start'] !== '' ? $entry['start'] : '00:00';
        $end = isset($entry['end']) && $entry['end'] !== '' ? $entry['end'] : '00:00';

        // garantir formato HH:MM
        $start = substr($start,0,5);
        $end = substr($end,0,5);

        $toInsert[] = [
            'weekday' => $weekday_db,
            'is_enable' => $is_enable,
            'start' => $start,
            'end' => $end
        ];
    }

    if (empty($toInsert)) throw new Exception('Nenhum horário válido para gravar.');

    // Gravar: apagar existentes e inserir os recebidos (frontend envia 7 entradas)
    if (isset($pdo) && $pdo instanceof PDO) {
        $pdo->beginTransaction();
        $pdo->exec("DELETE FROM horarios_funcionamento");
        $stmt = $pdo->prepare("INSERT INTO horarios_funcionamento (weekday, is_enable, start_time, end_time, created_at) VALUES (:weekday, :is_enable, :start_time, :end_time, GETDATE())");
        foreach ($toInsert as $r) {
            $stmt->execute([
                ':weekday' => $r['weekday'],
                ':is_enable' => $r['is_enable'],
                ':start_time' => $r['start'],
                ':end_time' => $r['end']
            ]);
        }
        $pdo->commit();
    }
    elseif (isset($conn) && function_exists('sqlsrv_query')) {
        $tx = sqlsrv_begin_transaction($conn);
        // apagar
        $del = sqlsrv_query($conn, "DELETE FROM horarios_funcionamento");
        if ($del === false) throw new Exception(print_r(sqlsrv_errors(), true));
        $sql = "INSERT INTO horarios_funcionamento (weekday, is_enable, start_time, end_time, created_at) VALUES (?, ?, ?, ?, GETDATE())";
        foreach ($toInsert as $r) {
            $params = [$r['weekday'], $r['is_enable'], $r['start'], $r['end']];
            $res = sqlsrv_query($conn, $sql, $params);
            if ($res === false) throw new Exception(print_r(sqlsrv_errors(), true));
        }
        sqlsrv_commit($conn);
    }
    elseif (isset($mysqli) && $mysqli instanceof mysqli) {
        $mysqli->begin_transaction();
        $mysqli->query("DELETE FROM horarios_funcionamento");
        $stmt = $mysqli->prepare("INSERT INTO horarios_funcionamento (weekday, is_enable, start_time, end_time, created_at) VALUES (?, ?, ?, ?, NOW())");
        if (!$stmt) throw new Exception($mysqli->error);
        foreach ($toInsert as $r) {
            $stmt->bind_param("iiss", $r['weekday'], $r['is_enable'], $r['start'], $r['end']);
            $stmt->execute();
        }
        $mysqli->commit();
    } else {
        throw new Exception('Nenhuma conexão à BD detectada. Verifique bd/conexao.php e as variáveis expostas.');
    }

    echo json_encode(['success' => true], JSON_UNESCAPED_UNICODE);
    exit;
} catch (Exception $e) {
    if (isset($pdo) && $pdo instanceof PDO && $pdo->inTransaction()) $pdo->rollBack();
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => $e->getMessage()], JSON_UNESCAPED_UNICODE);
    exit;
}
?>