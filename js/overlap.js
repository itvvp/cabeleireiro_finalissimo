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

  // mostrar successModal quando resp.case === 0
  if (resp && resp.case === 0) {
    var $success = $('#successModal');
    if ($success.length === 0) {
      var successHtml = '<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">' +
                        '<div class="modal-dialog modal-dialog-centered" role="document">' +
                          '<div class="modal-content">' +
                            '<div class="modal-header"><h5 class="modal-title" id="successModalLabel">Sucesso</h5>' +
                            '<button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button></div>' +
                            '<div class="modal-body">Operação concluída com sucesso.</div>' +
                            '<div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button></div>' +
                          '</div>' +
                        '</div>' +
                       '</div>';
      $('body').append(successHtml);
      $success = $('#successModal');
    }
    try {
      if (typeof $success.modal === 'function') {
        $success.appendTo('body');
        $success.modal('show');
      } else {
        $success.show();
        alert('Operação concluída com sucesso.');
      }
    } catch (err) {
      console.error('Erro ao mostrar successModal:', err);
      alert('Operação concluída com sucesso.');
    }
    return;
  }

  if (!resp.success) {
    $('#overlapsModal').show();
    if (resp.overlaps && Array.isArray(resp.overlaps) && resp.overlaps.length > 0) {
      showOverlaps(resp.overlaps);
    }
  } else {
    $('#overlapsModal').hide();
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
    var html = '<div class="table-responsive"><table class="table table-sm table-striped"><thead><tr>' +
               '<th>Serviço</th><th>Cliente</th><th>Quarto</th><th>Início</th><th>Fim</th><th>Notas</th>' +
               '</tr></thead><tbody>';
    overlaps.forEach(function(o){
      html += '<tr>';
      html += '<td>' + escapeHtml(o.title || '') + '</td>';
      html += '<td>' + escapeHtml(o.nome_hospede || o.cliente || '') + '</td>';
      html += '<td>' + escapeHtml(o.quarto || '') + '</td>';
      html += '<td>' + escapeHtml(o.start_event || o.start || '') + '</td>';
      html += '<td>' + escapeHtml(o.end_event || o.end || '') + '</td>';
      html += '<td>' + escapeHtml(o.notas || '') + '</td>';
      html += '</tr>';
    });
    html += '</tbody></table></div>';

    // garantir que o modal existe e está no body
    var $modal = $('#overlapsModal');
    if ($modal.length === 0) {
      console.warn('overlapsModal não encontrado no DOM — injetando modal mínimo.');
      var modalHtml = '<div class="modal fade" id="overlapsModal" tabindex="-1" role="dialog" aria-labelledby="overlapsModalLabel" aria-hidden="true">' +
                      '<div class="modal-dialog modal modal-dialog-centered" role="document">' 
                        '<div class="modal-content bg-dark text-white">' 
                          '<div class="modal-header">' 
                            '<h5 class="modal-title" id="overlapsModalLabel">Marcações ativas que colidem</h5>' 
                            '<button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>' +
                          '</div>' 
                          '<div class="modal-body" id="overlapsModalBody"></div>' +
                          '<div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button></div>' +
                        '</div>' 
                      '</div>' 
                    '</div>';
      $('body').append(modalHtml);
      $modal = $('#overlapsModal');
    }

    $modal.find('#overlapsModalBody').html(html);

    // garantir que o modal não está embebido dentro de outro modal e que o plugin bootstrap está disponível
    try {
      if (typeof $modal.modal === 'function') {
        $modal.appendTo('body');
        $modal.modal('show');
      } else {
        // fallback visual simples
        $modal.show();
        alert('Foram encontrados conflitos. Verifique o modal de conflitos na interface.');
      }
    } catch (err) {
      console.error('Erro ao mostrar overlaps modal:', err);
      alert('Erro ao mostrar modal de conflitos. Ver console.');
    }
  }

  function escapeHtml(str) {
    return String(str || '').replace(/[&<>"'\/]/g, function (s) {
      return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;','/':'&#x2F;'}[s];
    });
  }
});