<?php
session_start();
include("../bd/conexao.php");
header('Content-Type: application/json');

$data = [];
$error = [];

// aceitar ambos os nomes de terapeuta: terapeuta_id ou cabeleireira
$terapeuta_id = isset($_REQUEST['terapeuta_id']) ? intval($_REQUEST['terapeuta_id']) : (isset($_REQUEST['cabeleireira']) ? intval($_REQUEST['cabeleireira']) : 0);

// aceitar ambos os nomes de dias: dias_folga[] ou dias_semana[]
$dias_folga_raw = $_REQUEST['dias_folga'] ?? $_REQUEST['dias_semana'] ?? null;

// validações
if ($terapeuta_id <= 0) {
    $error['terapeuta_id'] = 'terapeuta_id inválido';
}

// normalizar dias para array
$dias = [];
if (is_array($dias_folga_raw)) {
    $dias = $dias_folga_raw;
} elseif (is_string($dias_folga_raw) && strlen(trim($dias_folga_raw)) > 0) {
    $dias = preg_split('/[,\;]+/', $dias_folga_raw);
}
$dias = array_values(array_filter(array_map('trim', $dias), function($v){ return $v !== ''; }));

if (count($dias) == 0) {
    $error['dias_folga'] = 'Selecione pelo menos um dia de folga';
}

// permissão (mesma lógica existente)
$perfil = $_SESSION['perfil'] ?? null;
$sess_terapeuta = $_SESSION['terapeuta'] ?? null;
if ($perfil != 2 && $sess_terapeuta && intval($sess_terapeuta) !== $terapeuta_id) {
    http_response_code(403);
    echo json_encode(['success'=>false,'error'=>'Sem permissão para criar folgas para esta terapeuta']);
    exit;
}

if (!empty($error)) {
    echo json_encode(['success'=>false,'errors'=>$error]);
    exit;
}

// Verificar se os dias selecionados já estão associados a folgas para a mesma cabeleireira
$dias_str = implode(',', array_map('intval', $dias));
// Fixed: Use correct column name 'terapeutas_id' (matches table schema)
$sql_check = "SELECT COUNT(*) as count FROM folgas WHERE terapeutas_id = ? AND dias_folga IN ($dias_str)";
$stmt_check = sqlsrv_prepare($conn, $sql_check, [$terapeuta_id]);
if (!$stmt_check || !sqlsrv_execute($stmt_check)) {
    echo json_encode(['success' => false, 'errors' => sqlsrv_errors()]);
    exit;
}
$row = sqlsrv_fetch_array($stmt_check, SQLSRV_FETCH_ASSOC);
if ($row['count'] > 0) {
    echo json_encode(['success' => false, 'errors' => 'Um ou mais dias da semana já estão associados a folgas para esta cabeleireira.']);
    exit;
}

// Removed: Unnecessary ID generation if 'id' is auto-increment

// Define the insert SQL (was missing) - use correct column name
$insert_sql = "INSERT INTO folgas (terapeutas_id, dias_folga) VALUES (?, ?)";
// Insert new folga entries
$success_count = 0;
$failed = [];
$failed_errors = [];
foreach ($dias as $dia) {
    $dia = trim($dia);
    if ($dia === '') { continue; }
    if (!ctype_digit((string)$dia) && !is_numeric($dia)) {
        $failed[] = $dia;
        $failed_errors[] = 'valor inválido';
        continue;
    }

    $dia_int = intval($dia);
    if ($dia_int === 0) $dia_int = 7;

    $params = [ intval($terapeuta_id), $dia_int ];
    $stmt = sqlsrv_query($conn, $insert_sql, $params);
    if ($stmt === false) {
        $err = sqlsrv_errors();
        $failed[] = $dia;
        $failed_errors[] = $err ? json_encode($err) : 'unknown sql error';
    } else {
        $success_count++;
    }
}

if ($success_count > 0) {
    // Call create_events_folgas.php to generate events for 2027
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . '/create_events_folgas.php');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
        'terapeuta_id' => $terapeuta_id,
        'dias' => $dias
    ]));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    $event_result = json_decode($response, true);
    if ($event_result && $event_result['success']) {
        $data['events_inserted'] = $event_result['inserted'];
    } else {
        $data['warning'] = 'Folgas criadas, mas eventos não foram gerados.';
    }

    $data['success'] = true;
    $data['inserted'] = $success_count;
    if (!empty($failed)) {
        $data['warning'] = 'Alguns dias não foram inseridos';
        $data['failed'] = $failed;
        $data['failed_errors'] = $failed_errors;
    }
} else {
    http_response_code(500);
    $data['success'] = false;
    $data['errors'] = ['db' => 'Nenhum dia foi inserido', 'details' => $failed_errors];
}

echo json_encode($data);
exit;
?>