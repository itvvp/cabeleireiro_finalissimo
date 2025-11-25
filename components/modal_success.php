<?php
?>
<link rel="stylesheet" href="/app-assets/css/modal-success.css">

<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="icon-wrap" aria-hidden="true">
          <!-- ícone check moderno -->
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <circle cx="12" cy="12" r="11.25" fill="rgba(255,255,255,0.12)" stroke="rgba(255,255,255,0.18)"/>
            <path d="M7.5 12.5L10.25 15.25L16.5 9" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
        <h5 class="modal-title text-light" id="successModalLabel">Sucesso</h5>
        <button type="button" class="close text-white ml-auto" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body" id="successModalBody">
        Dados guardados com sucesso.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="successModalOk">OK</button>
      </div>
    </div>
  </div>
</div>

<script>
/* foco acessível e pequena animação ao abrir */
document.addEventListener('DOMContentLoaded', function(){
  var modal = document.getElementById('successModal');
  if (!modal) return;
  // ao abrir pelo bootstrap: focar o botão OK
  $(modal).on('shown.bs.modal', function () {
    var ok = document.getElementById('successModalOk');
    if (ok) ok.focus();
  });
});
</script>