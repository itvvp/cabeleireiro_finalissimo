<?php
?>
<style>
/* estilos modernos e locais para o modal de sucesso */
#successModal .modal-dialog { max-width: 420px; }
#successModal .modal-content {
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 18px 40px rgba(16,24,40,0.18);
  border: 0;
  background: linear-gradient(180deg,#ffffff 0%, #fbfdff 100%);
}
#successModal .modal-header {
  background: linear-gradient(90deg, #657eb9ff 0%, #2575fc 100%);  color: #fff;
  border-bottom: 0;
  padding: 18px 20px;
  display: flex;
  align-items: center;
  gap: 12px;
  color: #fff;
}
#successModal .modal-title { font-weight: 600; font-size: 1.05rem; margin:0;color: #fff }
#successModal .modal-body { padding: 18px 20px; color: #17203a; font-size: 0.98rem; }
#successModal .modal-footer { border-top: 0; padding: 12px 20px 18px; background: transparent; }
#successModal .btn-primary {
  background: linear-gradient(90deg, #657eb9ff 0%, #2575fc 100%);  color: #fff;
  border: none;
  box-shadow: 0 6px 18px rgba(37,117,252,0.18);
  padding: 8px 18px;
  border-radius: 8px;
}
#successModal .icon-wrap { width:44px; height:44px; display:inline-flex; align-items:center; justify-content:center; background: rgba(255,255,255,0.12); border-radius: 10px; }
.modal-backdrop.show { backdrop-filter: blur(4px); -webkit-backdrop-filter: blur(4px); }
#successModal .modal-dialog { transform: translateY(-6px); transition: transform .28s cubic-bezier(.22,.9,.3,1); }
#successModal.show .modal-dialog { transform: translateY(0); }
</style>

<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content border-0 rounded shadow-lg">
      <div class="modal-header bg-primary text-white border-0 d-flex align-items-center">
        <div class="d-inline-flex align-items-center justify-content-center bg-white rounded mr-2 p-2">
          <!-- ícone check moderno -->
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" focusable="false">
            <circle cx="12" cy="12" r="11.25" fill="rgba(0,0,0,0.06)" stroke="rgba(255,255,255,0.18)"/>
            <path d="M7.5 12.5L10.25 15.25L16.5 9" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>

        <h5 class="modal-title mb-0" id="successModalLabel">Sucesso</h5>
        <button type="button" class="close text-white ml-auto" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
      </div>

      <div class="modal-body">
        <p class="mb-0">Dados guardados com sucesso.</p>
      </div>

      <div class="modal-footer border-0">
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="successModalOk">OK</button>
      </div>
    </div>
  </div>
</div>

<script>
/* foco acessível ao abrir */
document.addEventListener('DOMContentLoaded', function(){
  var modal = document.getElementById('successModal');
  if (!modal) return;
  $(modal).on('shown.bs.modal', function () {
    var ok = document.getElementById('successModalOk');
    if (ok) ok.focus();
  });
});
</script>