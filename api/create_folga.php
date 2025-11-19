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
$sql_check = "SELECT COUNT(*) as count FROM folgas WHERE cabeleireira = ? AND dia_semana IN ($dias_str)";
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

// Gerar um novo ID para a folga (assumindo que id_folga é auto-incremento ou gerado)
// Se id_folga não for auto-incremento, ajuste conforme necessário
$sql_max = "SELECT MAX(id_folga) as max_id FROM folgas";
$stmt_max = sqlsrv_query($conn, $sql_max);
$row_max = sqlsrv_fetch_array($stmt_max, SQLSRV_FETCH_ASSOC);
$new_id = ($row_max['max_id'] ?? 0) + 1;

// Insert new folga entries
foreach ($dias as $dia) {
    $dia = trim($dia);
    if ($dia === '') { continue; }
    if (!ctype_digit((string)$dia) && !is_numeric($dia)) {
        $failed[] = $dia;
        $failed_errors[] = 'valor inválido';
        continue;
    }

    $dia_int = intval($dia);
    // normalização: o form usa 0 para Domingo -> converte para 7 se necessário
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

<!-- language: html -->
<form id="folgaForm">
  <label for="terapeuta">Terapeuta</label>
  <select id="terapeuta" name="terapeuta_id" required>
    <!-- preencher com options do servidor -->
    <option value="1">Terapeuta 1</option>
    <option value="2">Terapeuta 2</option>
  </select>

  <fieldset>
    <legend>Selecione dias de folga</legend>
    <label><input type="checkbox" name="dias_folga[]" value="1"> Segunda (1)</label>
    <label><input type="checkbox" name="dias_folga[]" value="2"> Terça (2)</label>
    <label><input type="checkbox" name="dias_folga[]" value="3"> Quarta (3)</label>
    <label><input type="checkbox" name="dias_folga[]" value="4"> Quinta (4)</label>
    <label><input type="checkbox" name="dias_folga[]" value="5"> Sexta (5)</label>
    <label><input type="checkbox" name="dias_folga[]" value="6"> Sábado (6)</label>
    <label><input type="checkbox" name="dias_folga[]" value="7"> Domingo (7)</label>
  </fieldset>

  <button type="submit">Gravar folgas</button>
</form>

<div id="msg"></div>

<script>
document.getElementById('folgaForm').addEventListener('submit', function(e){
  e.preventDefault();
  var form = e.target;
  var formData = new FormData(form);

  // enviar como array (dias_folga[]) — create_folga.php aceita array ou string
  fetch('api/create_folga.php', {
    method: 'POST',
    body: formData,
    credentials: 'same-origin'
  }).then(function(res){ return res.json(); })
    .then(function(json){
      var msg = document.getElementById('msg');
      if (json.success) {
        msg.textContent = 'Folgas gravadas: ' + (json.inserted || 0);
        if (json.warning) { msg.textContent += ' — ' + json.warning; }
      } else {
        msg.textContent = 'Erro: ' + (json.errors ? JSON.stringify(json.errors) : (json.error||'desconhecido'));
      }
    }).catch(function(err){
      document.getElementById('msg').textContent = 'Erro de rede';
      console.error(err);
    });
});
</script>