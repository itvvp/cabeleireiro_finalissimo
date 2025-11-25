<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

if (!file_exists(__DIR__ . '/../bd/conexao.php')) {
  http_response_code(500);
  echo json_encode(['success' => false, 'error' => 'Ficheiro de conexão não encontrado']);
  exit;
}
include __DIR__ . '/../bd/conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405);
  echo json_encode(['success' => false, 'error' => 'Método não permitido']);
  exit;
}

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
if ($id <= 0) {
  http_response_code(400);
  echo json_encode(['success' => false, 'error' => 'ID inválido']);
  exit;
}


if (!isset($conn) || !$conn) {
  http_response_code(500);
  echo json_encode(['success' => false, 'error' => 'Conexão à BD não encontrada']);
  exit;
}

$sql = "DELETE FROM ferias WHERE id = ?";

// Adicionar os parâmetros correspondentes ao "?"
$params = [$id];

$stmt = sqlsrv_prepare($conn, $sql, $params);
if ($stmt === false) {
  $errs = sqlsrv_errors();
  http_response_code(500);
  echo json_encode(['success' => false, 'error' => 'Erro a preparar query', 'details' => $errs ? $errs : null]);
  exit;
}

$exec = @sqlsrv_execute($stmt);
if ($exec === false) {
  $errs = sqlsrv_errors();
  sqlsrv_free_stmt($stmt);
  http_response_code(500);
  echo json_encode(['success' => false, 'error' => 'Erro a executar query', 'details' => $errs ? $errs : null]);
  exit;
}

$rows = sqlsrv_rows_affected($stmt);
sqlsrv_free_stmt($stmt);

if ($rows !== false && $rows > 0) {
  echo json_encode(['success' => true, 'deleted_rows' => $rows]);
  exit;
}

// nada apagado
http_response_code(404);
echo json_encode(['success' => false, 'error' => 'Registo não encontrado / não apagado', 'deleted_rows' => $rows]);
exit;
?>
