<?php

?>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
    <button type="button" id="deleteEvent" class="btn btn-danger" data-cabeleireira="">Apagar Marcação</button>
</div>
<script>
(function($){
  // remove possíveis bindings anteriores com o mesmo namespace, depois liga só 1 handler
  console.log('[DEBUG] modal_dados_marcacao_actions: unbinding #deleteEvent handlers');
  $('body').off('click.deleteAction', '#deleteEvent');

  $('body').on('click.deleteAction', '#deleteEvent', function(event) {
    event.preventDefault();
    event.stopImmediatePropagation();


    // bloqueio para evitar segundo confirm se o handler for ligado duas vezes
    if (window._deleteConfirmOpen) {
      return;
    }

    window._deleteConfirmOpen = true;

    var id = $('#editEventId').val();
    if (!id) { alert('ID inválido'); console.log('[DEBUG] abort: id inválido'); window._deleteConfirmOpen = false; return; }

    var confirmed = confirm('Tem a certeza que deseja remover esta marcação? Action');
    if (!confirmed) {
      window._deleteConfirmOpen = false;
      return;
    }

    var cabeleireira = $(this).data('cabeleireira') || '';
    console.log('[DEBUG] cabeleireira:', cabeleireira);

    $.ajax({
      url: 'api/delete.php',
      type: 'POST',
      dataType: 'json',
      data: { id: id, cabeleireira: cabeleireira },
      beforeSend: function() { console.log('[DEBUG] AJAX beforeSend ->', this.url, this.data); }
    }).done(function(resp){
      console.log('[DEBUG] AJAX done resp:', resp);
      window._deleteConfirmOpen = false;
      if (resp && resp.success) {
        console.log('[DEBUG] delete success, hiding modal');
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
        alert(resp && resp.error ? resp.error : 'Erro ao apagar o registo.');
      }
    }).fail(function(xhr){
      window._deleteConfirmOpen = false;
      var msg = 'Erro na comunicação com o servidor.';
      if (xhr && xhr.responseJSON && xhr.responseJSON.error) msg = xhr.responseJSON.error;
      alert(msg);
    });
  });
})(jQuery);
</script>
