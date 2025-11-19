<?php
session_start();
include __DIR__ . '/../bd/conexao.php';
header('Content-Type: application/json');

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
if ($id <= 0) {
    echo json_encode(['success' => false, 'error' => 'ID inválido']);
    exit;
}

// Retrieve dias before deleting
$sql_get_dias = "SELECT dias_folga FROM folgas WHERE terapeutas_id = ?";
$stmt_get = sqlsrv_prepare($conn, $sql_get_dias, [$id]);
if (!$stmt_get || !sqlsrv_execute($stmt_get)) {
    echo json_encode(['success' => false, 'error' => sqlsrv_errors()]);
    exit;
}
$dias = [];
while ($row = sqlsrv_fetch_array($stmt_get, SQLSRV_FETCH_ASSOC)) {
    $dias[] = intval($row['dias_folga']);
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

// Delete events for 2027 folgas
if (!empty($dias)) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . '/delete_events_folgas.php');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
        'terapeuta_id' => $id,
        'dias' => $dias
    ]));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    $event_result = json_decode($response, true);
    if ($event_result && $event_result['success']) {
        // Events deleted
    }
}

echo json_encode(['success' => true, 'deleted' => max(0, $rows)]);
?>