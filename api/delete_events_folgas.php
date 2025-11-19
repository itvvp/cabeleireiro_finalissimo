<?php
include("../bd/conexao.php");
header('Content-Type: application/json');

$terapeuta_id = isset($_POST['terapeuta_id']) ? intval($_POST['terapeuta_id']) : 0;

if ($terapeuta_id <= 0) {
    echo json_encode(['success' => false, 'error' => 'terapeuta_id missing/invalid']);
    exit;
}

// Delete all folga events for the terapeuta in 2027

$sql = "DELETE FROM events WHERE cabeleireira = ? AND id_tratamento = 9999 AND title = 'Folga' AND start_event >= '2027-01-01 00:00:00' AND start_event < '2028-01-01 00:00:00'";
$params = [$terapeuta_id];
$stmt = sqlsrv_query($conn, $sql, $params);

$deleted = 0;
if ($stmt !== false) {
    $deleted = sqlsrv_rows_affected($stmt) ?: 0;
}

echo json_encode(['success' => true, 'deleted' => $deleted]);
?>