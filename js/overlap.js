$(function(){
  var isSubmitting = false;
  var $form = $('#createEvent');

  // remove quaisquer handlers antigos e liga só este
  $form.off('submit').on('submit', function(e){
    e.preventDefault();
    e.stopImmediatePropagation();
    if (isSubmitting) return false;
    isSubmitting = true;

    var data = $form.serialize();

    $.post('api/insert_ind.php', data, function(resp){
      console.log('api/insert_ind response', resp);

      if (!resp.success) {
        $('#erro_inserir').show();
        if (resp.overlaps && Array.isArray(resp.overlaps) && resp.overlaps.length > 0) {
          showOverlaps(resp.overlaps);
        }
      } else {
        $('#erro_inserir').hide();
        $form[0].reset();
        $('#addeventmodal').modal('hide');
        if (typeof calendar !== 'undefined' && typeof calendar.refetchEvents === 'function') {
          calendar.refetchEvents();
        } else {
          location.reload();
        }
      }
    }, 'json').fail(function(xhr){
      console.error('ajax error', xhr.responseText);
    }).always(function(){ isSubmitting = false; });
  });

  function showOverlaps(overlaps) {
    if (!Array.isArray(overlaps) || overlaps.length === 0) return;
    var html = '<div class="table-responsive"><table class="table table-sm table-striped"><thead><tr><th>Título</th><th>Cliente</th><th>Quarto</th><th>Início</th><th>Fim</th><th>Notas</th></tr></thead><tbody>';
    overlaps.forEach(function(o){
      html += '<tr><td>' + escapeHtml(o.title) + '</td>';
      html += '<td>' + escapeHtml(o.nome_hospede || o.cliente || '') + '</td>';
      html += '<td>' + escapeHtml(o.quarto || '') + '</td>';
      html += '<td>' + escapeHtml(o.start_event || o.start) + '</td>';
      html += '<td>' + escapeHtml(o.end_event || o.end) + '</td>';
      html += '<td>' + escapeHtml(o.notas) + '</td></tr>';
    });
    html += '</tbody></table></div>';
    $('#overlapsModalBody').html(html);
    $('#overlapsModal').modal('show');
  }

  function escapeHtml(str) {
    return String(str || '').replace(/[&<>"'\/]/g, function (s) {
      return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;','/':'&#x2F;'}[s];
    });
  }
});