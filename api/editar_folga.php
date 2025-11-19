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

echo json_encode(['success' => true]);
exit;
?>

<script>
  // Alternar entre modos de gravação e edição
  function toggleEditMode(isEdit, folgaId = null) {
    if (isEdit) {
      $('#gravar_folga').addClass('d-none');
      $('#editar_folga').removeClass('d-none').data('folga-id', folgaId);
    } else {
      $('#gravar_folga').removeClass('d-none');
      $('#editar_folga').addClass('d-none').data('folga-id', null);
    }
  }

  // Envio AJAX para editar folga
  $('#editar_folga').on('click', function () {
    var folgaId = $(this).data('folga-id');
    var $btn = $(this).prop('disabled', true);
    $.ajax({
      url: 'api/editar_folga.php',
      method: 'POST',
      data: $('#createFolga').serialize() + '&id=' + folgaId,
      dataType: 'json'
    }).done(function (resp) {
      if (resp.success) {
        $('#folgaFeedback').html('<div class="alert alert-success">Folga editada com sucesso.</div>');
        $('#createFolga')[0].reset();
        toggleEditMode(false);
        loadFolgas();
      } else {
        var err = JSON.stringify(resp.errors);
        $('#folgaFeedback').html('<div class="alert alert-danger">Erro: ' + err + '</div>');
      }
    }).fail(function () {
      $('#folgaFeedback').html('<div class="alert alert-danger">Erro de comunicação com o servidor.</div>');
    }).always(function () {
      $btn.prop('disabled', false);
    });
  });

  // Exemplo: carregar folga para edição
  function loadFolgaForEdit(folgaId) {
    $.getJSON('api/get_folga.php', { id: folgaId }, function (resp) {
      if (resp.success) {
        // Preencher o formulário com os dados da folga
        $('#cabeleireira').val(resp.data.cabeleireira);
        resp.data.dias.forEach(function (dia) {
          $('#ds_' + dia).prop('checked', true);
        });
        toggleEditMode(true, folgaId);
      } else {
        $('#folgaFeedback').html('<div class="alert alert-danger">Erro ao carregar folga para edição.</div>');
      }
    });
  }
</script>