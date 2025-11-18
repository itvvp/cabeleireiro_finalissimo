<?php

?>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
    <button type="button" id="deleteEvent" class="btn btn-danger" data-cabeleireira="">Apagar Marcação</button>
</div>
<script>
(function($){
  // delete genérico: usa o id em #editEventId e opcionalmente data-cabeleireira no botão
  $('body').on('click', '#deleteEvent', function() {
    var id = $('#editEventId').val();
    if (!id) { alert('ID inválido'); return; }
    if (!confirm('Tem a certeza que deseja remover esta marcação?')) return;

    var cabeleireira = $(this).data('cabeleireira') || '';

    $.ajax({
      url: 'api/delete.php',
      type: 'POST',
      dataType: 'json',
      data: { id: id, cabeleireira: cabeleireira }
    }).done(function(resp){
      if (resp && resp.success) {
        $('#editeventmodal').modal('hide');
        // refresh calendar(s)
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
      var msg = 'Erro na comunicação com o servidor.';
      if (xhr && xhr.responseJSON && xhr.responseJSON.error) msg = xhr.responseJSON.error;
      alert(msg);
    });
  });
})(jQuery);
</script>
