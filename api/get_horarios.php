<?php
header('Content-Type: application/json; charset=utf-8');

try {
    require_once __DIR__ . '/../bd/conexao.php';

    $rows = [];

    if (isset($pdo) && $pdo instanceof PDO) {
        $sql = "SELECT weekday, CAST(is_enable AS INT) AS is_enable, CONVERT(VARCHAR(5), start_time, 108) AS start_time, CONVERT(VARCHAR(5), end_time, 108) AS end_time FROM horarios_funcionamento ORDER BY weekday";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    elseif (isset($conn) && function_exists('sqlsrv_query')) {
        $sql = "SELECT weekday, is_enable, CONVERT(VARCHAR(5), start_time, 108) AS start_time, CONVERT(VARCHAR(5), end_time, 108) AS end_time FROM horarios_funcionamento ORDER BY weekday";
        $res = sqlsrv_query($conn, $sql);
        if ($res === false) throw new Exception(print_r(sqlsrv_errors(), true));
        while ($r = sqlsrv_fetch_array($res, SQLSRV_FETCH_ASSOC)) {
            $r['is_enable'] = (int)$r['is_enable'];
            $rows[] = $r;
        }
    }
    elseif (isset($mysqli) && $mysqli instanceof mysqli) {
        $sql = "SELECT weekday, is_enable, TIME_FORMAT(start_time,'%H:%i') AS start_time, TIME_FORMAT(end_time,'%H:%i') AS end_time FROM horarios_funcionamento ORDER BY weekday";
        $res = $mysqli->query($sql);
        if ($res === false) throw new Exception($mysqli->error);
        while ($r = $res->fetch_assoc()) {
            $r['is_enable'] = (int)$r['is_enable'];
            $rows[] = $r;
        }
    }
    else {
        throw new Exception('Nenhuma conexão à BD detectada. Verifique bd/conexao.php e as variáveis expostas (ex: $pdo, $conn, $mysqli).');
    }

    // Normalizar weekday para novo padrão API: 1 = Domingo, 2 = Segunda, ..., 7 = Sábado
    // BD atual: 1 = Segunda, 2 = Terça, ..., 7 = Domingo
    // mapeamento: api = (db % 7) + 1  => db=7 -> api=1 ; db=1 -> api=2, etc.
    foreach ($rows as &$r) {
        $dbw = isset($r['weekday']) ? (int)$r['weekday'] : 0;
        $apiw = ($dbw % 7) + 1;
        $r['weekday'] = $apiw;
        if (isset($r['is_enable'])) $r['is_enable'] = (int)$r['is_enable'];
    }
    unset($r);

    echo json_encode(['success' => true, 'data' => $rows], JSON_UNESCAPED_UNICODE);
    exit;
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => $e->getMessage()], JSON_UNESCAPED_UNICODE);
    exit;
}
?>