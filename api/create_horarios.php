<?php
include("../bd/conexao.php");
header('Content-Type: application/json; charset=utf-8');

try {
    // Espera um POST com 'days' => array de { weekday, is_enable, start_time, end_time }
    $days = $_POST['days'] ?? null;
    if (!is_array($days)) throw new Exception('Parâmetro days ausente ou inválido.');

    // Utilitário para normalizar tempo para HH:MM:SS
    $normalizeTime = function($t) {
        if ($t === null) return null;
        if (preg_match('/^\d{2}:\d{2}(:\d{2})?/', $t, $m)) {
            $v = $m[0];
            return strlen($v) === 5 ? $v . ':00' : $v;
        }
        throw new Exception('Formato de hora inválido: ' . $t);
    };

    // Iniciar transação (sqlsrv)
    if (!isset($conn)) throw new Exception('Conexão à BD não encontrada (variável $conn).');
    if (!sqlsrv_begin_transaction($conn)) throw new Exception('Não foi possível iniciar transação: ' . print_r(sqlsrv_errors(), true));

    // Apagar horários existentes (substituição completa)
    $del = sqlsrv_query($conn, "DELETE FROM horarios_funcionamento");
    if ($del === false) throw new Exception('Erro ao apagar horários existentes: ' . print_r(sqlsrv_errors(), true));

    $insertSql = "INSERT INTO horarios_funcionamento (weekday, is_enable, start_time, end_time, created_at) VALUES (?, ?, ?, ?, GETDATE())";

    $hostBase = (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost');
    $basePath = rtrim(dirname($_SERVER['REQUEST_URI']), '/\\');
    $urlCreateBlocks = 'http://' . $hostBase . $basePath . '/create_horarios_funcionamento.php';

    $shouldTriggerBlocks = false; // <--- novo: marcar para disparar depois do commit

    foreach ($days as $entry) {
        // aceitar chaves alternativas
        $weekday = isset($entry['weekday']) ? intval($entry['weekday']) : (isset($entry['weekday_api']) ? intval($entry['weekday_api']) : null);
        $is_enable = isset($entry['is_enable']) ? (int)$entry['is_enable'] : (isset($entry['enabled']) ? (int)$entry['enabled'] : 0);
        $start_time = $normalizeTime($entry['start_time'] ?? ($entry['start'] ?? null));
        $end_time = $normalizeTime($entry['end_time'] ?? ($entry['end'] ?? null));

        if ($weekday === null) continue; // ignora entradas inválidas

        // Inserir na tabela
        $params = [$weekday, $is_enable, $start_time, $end_time];
        $res = sqlsrv_query($conn, $insertSql, $params);
        if ($res === false) throw new Exception('Erro ao inserir horario: ' . print_r(sqlsrv_errors(), true));

        $shouldTriggerBlocks = true; // pelo menos uma inserção feita — iremos disparar o script de bloqueios depois do commit

        // Obter ID inserido
        $id = null;
        $idRes = sqlsrv_query($conn, "SELECT SCOPE_IDENTITY() AS id");
        if ($idRes !== false && ($row = sqlsrv_fetch_array($idRes, SQLSRV_FETCH_ASSOC))) {
            $id = isset($row['id']) ? intval($row['id']) : null;
        }
    }

    if (!sqlsrv_commit($conn)) throw new Exception('Erro ao commitar transação: ' . print_r(sqlsrv_errors(), true));

    // Disparar o script que cria eventos de bloqueio APÓS o commit (chamada única para evitar timeouts)
    if ($shouldTriggerBlocks) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $urlCreateBlocks);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(['year' => 2027])); // apenas testes em 2027
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_TIMEOUT, 120); // aumentar timeout para operação pesada
        $resp = curl_exec($ch);
        $curlErr = curl_error($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($resp === false || ($httpCode >= 400 && $httpCode !== 0)) {
            // registar erro mas não reverter, já que o commit foi feito; devolve mensagem ao cliente
            echo json_encode(['success' => false, 'error' => "Erro na chamada a create_horarios_funcionamento.php (HTTP $httpCode) - $curlErr - resp: $resp"], JSON_UNESCAPED_UNICODE);
            exit;
        }
    }

    echo json_encode(['success' => true], JSON_UNESCAPED_UNICODE);
    exit;
} catch (Exception $e) {
    if (isset($conn)) sqlsrv_rollback($conn);
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => $e->getMessage()], JSON_UNESCAPED_UNICODE);
    exit;
}
?>