<?php

?>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
    <button type="button" id="deleteEvent" class="btn btn-danger" data-cabeleireira="">Apagar Marcação</button>
</div>
<script>
(function($){
  console.log('[DEBUG] modal_dados_marcacao_actions: unbinding #deleteEvent handlers');
  // remove bindings antigos
  $('body').off('click.deleteActionModal', '#deleteEvent');

  // ensure modals exist (append once)
  if ($('#confirmDeleteModal').length === 0) {
    $('body').append(
      '<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-hidden="true">' +
        '<div class="modal-dialog modal-sm" role="document">' +
          '<div class="modal-content">' +
            '<div class="modal-header"><h5 class="modal-title">Confirmar</h5>' +
            '<button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button></div>' +
            '<div class="modal-body"><p class="confirm-delete-message">Tem a certeza?</p></div>' +
            '<div class="modal-footer">' +
              '<button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancelDeleteBtn">Cancelar</button>' +
              '<button type="button" class="btn btn-danger" id="confirmDeleteBtn">Apagar</button>' +
            '</div>' +
          '</div>' +
        '</div>' +
      '</div>'
    );
  }

  if ($('#deleteErrorModal').length === 0) {
    $('body').append(
      '<div class="modal fade" id="deleteErrorModal" tabindex="-1" role="dialog" aria-hidden="true">' +
        '<div class="modal-dialog modal-sm" role="document">' +
          '<div class="modal-content">' +
            '<div class="modal-header"><h5 class="modal-title">Erro</h5>' +
            '<button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button></div>' +
            '<div class="modal-body"><p class="delete-error-message"></p></div>' +
            '<div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button></div>' +
          '</div>' +
        '</div>' +
      '</div>'
    );
  }

  // click no botão "Apagar Marcação" -> mostra modal de confirmação
  $('body').on('click.deleteActionModal', '#deleteEvent', function(event) {
    event.preventDefault();
    event.stopImmediatePropagation();

    // previne múltiplas aberturas concorrentes
    if (window._deleteConfirmOpen) return;
    window._deleteConfirmOpen = true;

    var id = $('#editEventId').val();
    if (!id) {
      $('#deleteErrorModal .delete-error-message').text('ID inválido.');
      $('#deleteErrorModal').modal('show');
      window._deleteConfirmOpen = false;
      return;
    }

    var cabeleireira = $(this).data('cabeleireira') || '';

    // guardar dados no modal
    $('#confirmDeleteModal').data('deleteId', id).data('deleteCabeleireira', cabeleireira);
    $('#confirmDeleteModal .confirm-delete-message').text('Tem a certeza que deseja remover esta marcação?');
    $('#confirmDeleteModal').modal('show');
  });

  // confirmar dentro do modal
  $('body').on('click', '#confirmDeleteBtn', function() {
    var $modal = $('#confirmDeleteModal');
    var id = $modal.data('deleteId');
    var cabeleireira = $modal.data('deleteCabeleireira') || '';

    // feedback visual: desactivar botão para evitar múltiplos submits
    $(this).prop('disabled', true).text('A apagar...');

    $.ajax({
      url: 'api/delete.php',
      type: 'POST',
      dataType: 'json',
      data: { id: id, cabeleireira: cabeleireira }
    }).done(function(resp){
      console.log('[DEBUG] AJAX done resp:', resp);
      $modal.modal('hide');
      $('#confirmDeleteBtn').prop('disabled', false).text('Apagar');
      window._deleteConfirmOpen = false;

      if (resp && resp.success) {
        $('#editeventmodal').modal('hide');
        if (typeof calendar !== 'undefined' && calendar.refetchEvents) {
          calendar.refetchEvents();
        } else if (typeof calendar3 !== 'undefined' && calendar3.refetchEvents) {
          calendar3.refetchEvents();
        } else if (typeof calendar4 !== 'undefined' && calendar4.refetchEvents) {
          calendar4.refetchEvents();
        } else {
          location.reload();
        }
      } else {
        var msg = (resp && resp.error) ? resp.error : 'Erro ao apagar o registo.';
        $('#deleteErrorModal .delete-error-message').text(msg);
        $('#deleteErrorModal').modal('show');
      }
    }).fail(function(xhr){
      console.log('[DEBUG] AJAX fail', xhr);
      $('#confirmDeleteBtn').prop('disabled', false).text('Apagar');
      window._deleteConfirmOpen = false;
      var msg = 'Erro na comunicação com o servidor.';
      if (xhr && xhr.responseJSON && xhr.responseJSON.error) msg = xhr.responseJSON.error;
      $('#deleteErrorModal .delete-error-message').text(msg);
      $('#deleteErrorModal').modal('show');
    });
  });

  // ao fechar o modal de confirmação (cancelar com X ou botão) liberta flag
  $('body').on('hidden.bs.modal', '#confirmDeleteModal', function () {
    window._deleteConfirmOpen = false;
    $('#confirmDeleteBtn').prop('disabled', false).text('Apagar');
  });

})(jQuery);
</script>
