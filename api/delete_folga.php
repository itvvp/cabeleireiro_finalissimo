<?php
session_start();
include __DIR__ . '/../bd/conexao.php';
header('Content-Type: application/json');

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
if ($id <= 0) {
    echo json_encode(['success' => false, 'error' => 'ID inválido']);
    exit;
}

// Apaga folgas pelo id do terapeuta (coluna correta: terapeutas_id)
$sql = "DELETE FROM folgas WHERE terapeutas_id = ?";
$params = [$id];

$stmt = sqlsrv_prepare($conn, $sql, $params);
if (!$stmt || !sqlsrv_execute($stmt)) {
    $errors = sqlsrv_errors();
    echo json_encode(['success' => false, 'error' => $errors]);
    exit;
}

$rows = sqlsrv_rows_affected($stmt);
if ($rows === false) {
    echo json_encode(['success' => false, 'error' => 'Não foi possível determinar linhas afectadas']);
    exit;
}

echo json_encode(['success' => true, 'deleted' => max(0, $rows)]);
?>