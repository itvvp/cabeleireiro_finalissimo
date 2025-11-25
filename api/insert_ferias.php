<?php
session_start();
include __DIR__ . "/../bd/conexao.php";
header('Content-Type: application/json; charset=utf-8');

// aceitar apenas cabeleireira_id no payload
$cabeleireira_id = isset($_REQUEST['cabeleireira_id']) ? intval($_REQUEST['cabeleireira_id']) : 0;

$start = isset($_REQUEST['start_ferias']) ? trim($_REQUEST['start_ferias']) : '';
$end   = isset($_REQUEST['end_ferias']) ? trim($_REQUEST['end_ferias']) : '';

$errors = [];

// validações básicas
if ($cabeleireira_id <= 0) $errors['cabeleireira_id'] = 'Selecione a cabeleireira';
if ($start == '') $errors['start_ferias'] = 'Selecione a data de início';
if ($end == '') $errors['end_ferias'] = 'Selecione a data de fim';

if (empty($errors)) {
    $start_ts = strtotime($start);
    $end_ts   = strtotime($end);
    if ($start_ts === false || $end_ts === false) {
        $errors['date'] = 'Datas inválidas';
    } else {
        $start_dt = date('Y-m-d 00:00:00', $start_ts);
        $end_dt   = date('Y-m-d 23:59:59', $end_ts);
        if ($end_ts < $start_ts) {
            $errors['range'] = 'A data de fim deve ser igual ou posterior à data de início';
            // adicionar datas recebidas para debugging
            echo json_encode(['success' => false, 'errors' => $errors, 'received' => ['start' => $start, 'end' => $end]]);
            exit;
        }
    }
}

if (!empty($errors)) {
    echo json_encode(['success' => false, 'errors' => $errors]);
    exit;
}

$created_at = date('Y-m-d H:i:s');

// Inserir na tabela ferias (colunas: cabeleireira_id, start_ferias, end_ferias, created_at)
$sql = "INSERT INTO ferias (cabeleireira_id, start_ferias, end_ferias, created_at) VALUES (?, ?, ?, ?)";
$params = [$cabeleireira_id, $start_dt, $end_dt, $created_at];
$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt === false) {
    $errs = sqlsrv_errors();
    $msg = [];
    if ($errs && is_array($errs)) {
        foreach ($errs as $e) {
            $msg[] = ($e['message'] ?? json_encode($e));
        }
    } else {
        $msg[] = 'db error';
    }
    echo json_encode(['success' => false, 'error' => implode(' | ', $msg)]);
    exit;
}

echo json_encode(['success' => true, 'message' => 'Férias gravadas']);
exit;
?>