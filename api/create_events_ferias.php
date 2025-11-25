<?php
header('Content-Type: application/json; charset=utf-8');
include("../bd/conexao.php");

$terapeuta_id = isset($_POST['terapeuta_id']) ? intval($_POST['terapeuta_id']) : 0;
$start = isset($_POST['start_date']) ? trim($_POST['start_date']) : '';
$end = isset($_POST['end_date']) ? trim($_POST['end_date']) : $start;
$notes = isset($_POST['notes']) ? trim($_POST['notes']) : '';

if ($terapeuta_id <= 0 || $start === '') {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Parâmetros inválidos. Forneça terapeuta_id e start_date (YYYY-MM-DD).']);
    exit;
}

// Valida e normaliza datas (espera formato YYYY-MM-DD)
$sd = DateTime::createFromFormat('Y-m-d', $start);
$ed = DateTime::createFromFormat('Y-m-d', $end);
if (!$sd) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'start_date inválida. Use YYYY-MM-DD.']);
    exit;
}
if (!$ed) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'end_date inválida. Use YYYY-MM-DD.']);
    exit;
}
if ($ed < $sd) {
    // troca se estiver ao contrário
    $tmp = $sd; $sd = $ed; $ed = $tmp;
}

$start_event = $sd->format('Y-m-d') . ' 00:00:00';
$end_event = $ed->format('Y-m-d') . ' 23:59:59';

$title = 'Férias';
$color = '#ff9900';
$text_color = '#ffffff';
$id_tratamento = 9999; // marca como bloqueio/indisponibilidade

$sql = "INSERT INTO events (title, start_event, end_event, color, text_color, id_tratamento, notas, cabeleireira) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$params = [$title, $start_event, $end_event, $color, $text_color, $id_tratamento, $notes, $terapeuta_id];

$stmt = sqlsrv_query($conn, $sql, $params);
if ($stmt === false) {
    $err = sqlsrv_errors();
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Erro ao inserir evento', 'details' => $err ? $err : null]);
    exit;
}

$rows = sqlsrv_rows_affected($stmt);
sqlsrv_free_stmt($stmt);

echo json_encode(['success' => true, 'inserted_rows' => $rows, 'title' => $title, 'start' => $start_event, 'end' => $end_event]);
exit;
?>