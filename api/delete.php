<?php
session_start();
include __DIR__ . "/../bd/conexao.php";

if (!isset($_POST['id'])) {
    http_response_code(400); echo json_encode(['error'=>'id missing']); exit;
}
$id = intval($_POST['id']);
$sess_terapeuta = $_SESSION['terapeuta'] ?? null;
$perfil = $_SESSION['perfil'] ?? null;

// se não for admin (perfil == 2), valida que o evento pertence à sessão
if ($perfil != 2) {
    $sql = "SELECT cabeleireira FROM events WHERE id = ?";
    $stmt = sqlsrv_query($conn, $sql, array($id));
    if ($stmt === false) { http_response_code(500); echo json_encode(['error'=>'db']); exit; }
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    if (!$row || $row['cabeleireira'] != $sess_terapeuta) {
        http_response_code(403); echo json_encode(['error'=>'Sem permissão']); exit;
    }
}

$sql = "DELETE FROM events WHERE id = ?";
$del = sqlsrv_query($conn, $sql, array($id));
if ($del === false) { http_response_code(500); echo json_encode(['error'=>'db delete']); exit; }

echo json_encode(['success'=>true]);
?>