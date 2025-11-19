<?php
include("../bd/conexao.php");
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'errors' => 'Método inválido']);
    exit;
}

$id = isset($_POST['id']) ? intval($_POST['id']) : 0; // id original (terapeuta)
$cabeleireira = isset($_POST['cabeleireira']) ? intval($_POST['cabeleireira']) : 0; // novo terapeuta selecionado no modal
$dias_semana = $_POST['dias_semana'] ?? [];

if (!$id || !$cabeleireira) {
    echo json_encode(['success' => false, 'errors' => 'ID ou cabeleireira não fornecidos.']);
    exit;
}

// Delete events for the original terapeuta
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . '/delete_events_folgas.php');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
    'terapeuta_id' => $id,
    'ano' => 2027
]));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

// Apaga folgas existentes para o terapeuta original
$sql = "DELETE FROM folgas WHERE terapeutas_id = ?";
$stmt = sqlsrv_prepare($conn, $sql, [$id]);
if (!$stmt || !sqlsrv_execute($stmt)) {
    echo json_encode(['success' => false, 'errors' => sqlsrv_errors()]);
    exit;
}

// Insere as novas folgas para o terapeuta selecionado
foreach ($dias_semana as $dia) {
    $dia_int = intval($dia);
    $sql = "INSERT INTO folgas (terapeutas_id, dias_folga) VALUES (?, ?)";
    $stmt = sqlsrv_prepare($conn, $sql, [$cabeleireira, $dia_int]);
    if (!$stmt || !sqlsrv_execute($stmt)) {
        echo json_encode(['success' => false, 'errors' => sqlsrv_errors()]);
        exit;
    }
}

// Create events for the new terapeuta
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . '/create_events_folgas.php');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
    'terapeuta_id' => $cabeleireira,
    'dias' => $dias_semana,
    'ano' => 2027
]));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

echo json_encode(['success' => true]);
exit;
?>
