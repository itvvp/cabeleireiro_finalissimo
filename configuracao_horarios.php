<?php
session_start();
include "bd/conexao.php";

date_default_timezone_set('Europe/Lisbon');
error_reporting(E_ALL & ~E_NOTICE);
?>
<!DOCTYPE html>
<html class="loading" lang="pt">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Configuração Horários</title>

    <!-- manter CSS da app -->
    <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="style.css">

    <link href='packages/core/main.css' rel='stylesheet' />
    <link href='packages/daygrid/main.css' rel='stylesheet' />
    <link href='packages/timegrid/main.css' rel='stylesheet' />
    <link href='packages/list/main.css' rel='stylesheet' />
    <link href='packages/bootstrap/css/bootstrap.css' rel='stylesheet' />
    <link href="packages/jqueryui/custom-theme/jquery-ui-1.10.4.custom.min.css" rel="stylesheet">
    <link href='packages/datepicker/datepicker.css' rel='stylesheet' />
    <link href='packages/colorpicker/bootstrap-colorpicker.min.css' rel='stylesheet' />
    <link href='style.css' rel='stylesheet' />

      <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/vendors.min.css">
 
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/components.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/horizontal-menu.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/pages/page-users.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <script src='packages/core/main.js'></script>
    <script src='packages/daygrid/main.js'></script>
    <script src='packages/timegrid/main.js'></script>
    <script src='packages/list/main.js'></script>
    <script src='packages/interaction/main.js'></script>
    <script src='packages/jquery/jquery.js'></script>
    <script src='packages/jqueryui/jqueryui.min.js'></script>
    <script src='packages/bootstrap/js/bootstrap.js'></script>
    <script src='packages/datepicker/datepicker.js'></script>
    <script src='packages/colorpicker/bootstrap-colorpicker.min.js'></script>
    <style>
      /* ajustes locais para o formulário mantendo o design */
      .cfg-card { max-width: 900px; margin: 20px auto; }
      .cfg-section { padding: 1rem; }
      .weekday-row .form-group { margin-bottom: .5rem; }
      .small-muted { font-size: .85rem; color:#6c757d; }

     /* linha de horário desactivada (is_enable = false) */
     .row-disabled { opacity: 0.55; }
    </style>
  </head>
  <body class="horizontal-layout horizontal-menu 2-columns" data-open="hover" data-menu="horizontal-menu" data-col="2-columns">

    <?php include "cabecalho.php"; ?>
    <?php include "menu_cima.php"; ?>

    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-body">

          <div class="card cfg-card">
            <div class="card-header">
              <h4 class="card-title">Configuração de Horários</h4>
            </div>

            <div class="card-content">
              <div class="card-body">

                <ul class="nav nav-tabs" id="cfgTabs" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="folgas-tab" data-toggle="tab" href="#folgas" role="tab">Folgas</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="horario-tab" data-toggle="tab" href="#horario" role="tab">Horário de Funcionamento</a>
                  </li>
                </ul>

                <div class="tab-content mt-2">
                  <!-- FOLGAS -->

                  
                  <div class="tab-pane fade show active" id="folgas" role="tabpanel">
                    <form id="createFolga" class="form">
                      <div class="row">
                         <div class="col-md-6">
                           <div class="form-group">
                             <label for="cabeleireira">Cabeleireira</label>
                             <select id="cabeleireira" name="cabeleireira" class="form-control" required>
                               <option value="">Selecione a cabeleireira</option>
                               <?php
                                 $sql="select * from terapeutas order by nome";
                                 $stmt = sqlsrv_query($conn, $sql);
                                 while ($r = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                                     echo '<option value="'.$r['id'].'">'.$r['nome'].'</option>';
                                 }
                               ?>
                             </select>
                           </div>
                         </div>

                         <div class="col-md-6">
                           <div class="form-group">
                             <label for="dias_semana">Dias da Semana</label>
                             <div id="dias_semana_group">
                               <?php
                          
                                 $dias = ['Domingo','Segunda-feira','Terça-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sábado'];
                                 for($i=1;$i<=7;$i++){
                                   echo '<div class="form-check">';
                                   echo '<input class="form-check-input" type="checkbox" name="dias_semana[]" id="ds_'.$i.'" value="'.$i.'">';
                                   echo '<label class="form-check-label" for="ds_'.$i.'">'.$dias[$i-1].'</label>';
                                   echo '</div>';
                                 }
                               ?>
                               <small class="small-muted">Marque vários dias conforme necessário.</small>
                             </div>
                           </div>
                         </div>
                       </div>

                       <div class="text-right">
                         <button type="submit" class="btn btn-primary" id="gravar_folga">Gravar Folga / Bloqueio</button>
                         <!-- <button type="button" class="btn btn-secondary d-none" id="editar_folga">Editar Folga</button> -->
                       </div>
                     </form>

                    <!-- container que será preenchido por AJAX via api/get_folgas.php -->
                    <div id="folgasTableContainer" class="mt-3"></div>

                    <div id="folgaFeedback" class="mt-2"></div>

                  </div>

                  <!-- HORÁRIO DE FUNCIONAMENTO -->
                  <div class="tab-pane fade" id="horario" role="tabpanel">
                      <!-- tabela estática para exibir horários (preenchida por loadHorarios) -->
                    <div class="table-responsive mt-3">
                      <table id="horariosTable" class="table table-striped mb-0">
                        <thead>
                          <tr>
                            <th>Dia</th>
                            <th>Ativo</th>
                            <th>Início</th>
                            <th>Fim</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr><td colspan="4" class="text-center">A carregar...</td></tr>
                        </tbody>
                      </table>
                    </div>

                   <div class="d-flex justify-content-end mt-2">
                     <button type="button" id="editBusinessHours" class="btn btn-secondary mr-2">Editar Horários</button>
                     <button type="button" id="cancelEditBH" class="btn btn-link d-none">Cancelar</button>
                   </div>
                    
                    <!-- form escondido até clicar em Editar -->
                    <form id="businessHoursForm" class="form" style="display:none">
                      <div class="row weekday-row">
                        <?php
                          // gera inputs com índices 1..7 (weekday = 1 => Domingo)
                          $diasShort = ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb'];
                          $bh_days = ['Domingo','Segunda-feira','Terça-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sábado'];
                          for($i=1;$i<=7;$i++){
                        ?>
                         <div class="col-md-4">
                           <div class="form-row d-flex flex-column align-items-center">
                             <div class="col-auto">
                               <div class="form-check">
                                <input class="form-check-input bh-enabled" type="checkbox" id="day_enable_<?php echo $i;?>" data-day="<?php echo $i;?>" name="bh_enabled[<?php echo $i;?>]" value="1">
                                 <label class="form-check-label" for="day_enable_<?php echo $i;?>"><?php echo $bh_days[$i-1]; ?></label>
                               </div>
                             </div>
                             <div class="col">
                               <div class="form-group mb-0">
                                <input type="time" class="form-control bh-start" id="bh_start_<?php echo $i;?>" name="bh_start[<?php echo $i;?>]" placeholder="Início" disabled>
                               </div>
                             </div>
                             <div class="col">
                               <div class="form-group mb-0">
                                <input type="time" class="form-control bh-end" id="bh_end_<?php echo $i;?>" name="bh_end[<?php echo $i;?>]" placeholder="Fim" disabled>
                               </div>
                             </div>
                           </div>
                         </div>
                        <?php } ?>
                       </div>

                      <p class="small-muted mt-2">Os horários de funcionamento servem apenas para visualização; para bloquear realmente períodos use a aba "Folgas / Bloqueios".</p>

                      <div class="text-right">
                        <button type="button" id="saveBusinessHours" class="btn btn-primary">Gravar Horário</button>
                      </div>
                    </form>

                    <div id="bhFeedback" class="mt-2"></div>

                  
                  </div>
                </div>

              </div>
            </div>
          </div>

        </div>
      </div>
    </div>

    <?php include "rodape_novo.php"; ?>

    <!-- manter scripts da app -->
    <script src="packages/jquery/jquery.js"></script>
    <script src="packages/bootstrap/js/bootstrap.js"></script>

    <script>
      // Wrap bindings so they run after DOM is ready (modal HTML is below)
      $(function(){
        // Habilitar / desabilitar inputs por dia
        $(document).on('change', '.bh-enabled', function(){
          var day = $(this).data('day');
          var enabled = $(this).is(':checked');
          $('#bh_start_' + day).prop('disabled', !enabled);
          $('#bh_end_' + day).prop('disabled', !enabled);
        });

        // Envio AJAX folga -> usa API existente (padrão de bloqueios em events)
        $('#createFolga').on('submit', function(e){
          e.preventDefault();
          var $btn = $(this).find('button[type="submit"]').prop('disabled', true);
          $.ajax({
            url: 'api/create_folga.php',
            method: 'POST',
            data: $(this).serialize(),
            dataType: 'json'
          }).done(function(resp){
            if (resp.success) {
              $('#folgaFeedback').html('<div class="alert alert-success">Folga gravada com sucesso.</div>');
              $('#createFolga')[0].reset();
              if (typeof calendar !== 'undefined' && calendar.refetchEvents) calendar.refetchEvents();
              loadFolgas();
            } else {
              var err = JSON.stringify(resp.errors);
              $('#folgaFeedback').html('<div class="alert alert-danger">Erro: '+err+'</div>');
            }
          }).fail(function(){
            $('#folgaFeedback').html('<div class="alert alert-danger">Erro de comunicação com o servidor.</div>');
          }).always(function(){ $btn.prop('disabled', false); });
        });

        // função para carregar folgas via API e renderizar tabela
        function loadFolgas() {
          $.getJSON('api/get_folgas.php', function (resp) {
            if (!resp.success) {
              $('#folgasTableContainer').html('<div class="alert alert-danger">Erro ao obter folgas.</div>');
              return;
            }
            var diasSemana = ['Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado'];
            var html = '<table class="table"><thead><tr><th>Terapeuta</th><th>Dias</th><th>Ações</th></tr></thead><tbody>';
            resp.data.forEach(function (folga) {
              var diasNomes = (folga.dias || []).map(function (dia) { return diasSemana[(dia||1) - 1]; });
              html += '<tr><td>' + folga.nome + '</td><td>' + diasNomes.join(', ') + '</td>';
              html += '<td>';
              html += ' <button class="btn btn-sm btn-danger btn-delete-folga ml-1" data-id="'+folga.id+'">Apagar</button>';
              html += '</td></tr>';
            });
            html += '</tbody></table>';
            $('#folgasTableContainer').html(html);
          }).fail(function(){ $('#folgasTableContainer').html('<div class="alert alert-danger">Erro ao obter folgas.</div>'); });
        }
        
        // Delegated handler para apagar folga
        $(document).on('click', '.btn-delete-folga', function(){
          var id = $(this).data('id');
          if (!confirm('Tem a certeza que pretende apagar esta folga?')) return;
          var $btn = $(this).prop('disabled', true);
          $.ajax({
            url: 'api/delete_folga.php',
            method: 'POST',
            data: { id: id },
            dataType: 'json'
          }).done(function(resp){
            if (resp.success) {
              $('#folgaFeedback').html('<div class="alert alert-success">Folga apagada com sucesso.</div>');
              if (typeof calendar !== 'undefined' && calendar.refetchEvents) calendar.refetchEvents();
              loadFolgas();
            } else {
              $('#folgaFeedback').html('<div class="alert alert-danger">Erro: ' + (resp.error || JSON.stringify(resp.errors)) + '</div>');
            }
          }).fail(function(){
            $('#folgaFeedback').html('<div class="alert alert-danger">Erro de comunicação ao apagar.</div>');
          }).always(function(){ $btn.prop('disabled', false); });
        });

        // Carregar folga para edição no modal
        function loadFolgaForEdit(folgaId) {
          $.getJSON('api/get_folgas.php', { id: folgaId })
            .done(function (resp) {
              if (resp.success) {
                $('#edit_cabeleireira').val(resp.data.cabeleireira);
                $('#editFolgaForm input[type="checkbox"]').prop('checked', false);
                (resp.data.dias || []).forEach(function (dia) { $('#edit_ds_' + dia).prop('checked', true); });
                $('#confirmEditFolga').data('folga-id', folgaId);
                $('#editFolgaModal').modal('show');
              } else {
                $('#folgaFeedback').html('<div class="alert alert-danger">Erro ao carregar folga para edição.</div>');
              }
            })
            .fail(function(xhr, status, err){
              console.error('get_folga error', status, err, xhr.responseText);
              $('#folgaFeedback').html('<div class="alert alert-danger">Erro ao carregar folga (ver console).</div>');
            });
        }

        // Envio AJAX para editar folga via modal
        $('#confirmEditFolga').on('click', function () {
          var folgaId = $(this).data('folga-id');
          var $btn = $(this).prop('disabled', true);
          $.ajax({
            url: 'api/editar_folga.php',
            method: 'POST',
            data: $('#editFolgaForm').serialize() + '&id=' + folgaId,
            dataType: 'json'
          }).done(function (resp) {
            if (resp.success) {
              $('#editFolgaFeedback').html('<div class="alert alert-success">Folga editada com sucesso.</div>');
              $('#editFolgaModal').modal('hide');
              loadFolgas();
            } else {
              var err = JSON.stringify(resp.errors);
              $('#editFolgaFeedback').html('<div class="alert alert-danger">Erro: ' + err + '</div>');
            }
          }).fail(function () {
            $('#editFolgaFeedback').html('<div class="alert alert-danger">Erro de comunicação com o servidor.</div>');
          }).always(function () {
            $btn.prop('disabled', false);
          });
        });

        // Limpar o feedback ao fechar o modal
        $('#editFolgaModal').on('hidden.bs.modal', function () { $('#editFolgaFeedback').html(''); });

        function escapeHtml(str){ return String(str).replace(/[&<>"'\/]/g, function (s) { return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;','/':'&#x2F;'}[s]; }); }

        // gravar horários -> envia para api/create_horarios.php
        $('#saveBusinessHours').on('click', function(){
          var $btn = $(this).prop('disabled', true);
          var fd = new FormData();
          for(var i=1;i<=7;i++){
             var enabled = $('#day_enable_'+i).is(':checked') ? 1 : 0;
             fd.append('days['+i+'][weekday]', i);
             fd.append('days['+i+'][enabled]', enabled);
             fd.append('days['+i+'][start]', $('#bh_start_'+i).val() || '');
             fd.append('days['+i+'][end]', $('#bh_end_'+i).val() || '');
           }
           $.ajax({
             url: 'api/create_horarios.php',
             method: 'POST',
             data: fd,
             processData: false,
             contentType: false,
             dataType: 'json'
           }).done(function(resp){
            if (resp.success) {
              $('#bhFeedback').html('<div class="alert alert-success">Horários gravados.</div>');
              $('#businessHoursForm').hide();
              $('#cancelEditBH').addClass('d-none');
              $('#editBusinessHours').prop('disabled', false);
              loadHorarios();
            } else {
              $('#bhFeedback').html('<div class="alert alert-danger">Erro: '+(resp.error || JSON.stringify(resp.errors))+'</div>');
            }
          }).fail(function(){ $('#bhFeedback').html('<div class="alert alert-danger">Erro de comunicação.</div>'); })
          .always(function(){ $btn.prop('disabled', false); });
        });

        // popula o formulário com os dados retornados pela API
        function populateBusinessHours(data){
          for(var i=1;i<=7;i++){
            $('#day_enable_'+i).prop('checked', false);
            $('#bh_start_'+i).val('').prop('disabled', true);
            $('#bh_end_'+i).val('').prop('disabled', true);
          }
          (data || []).forEach(function(r){
            var w = r.weekday;
            if (w === null || w === undefined) return;
            var idx = parseInt(w,10);
            if (isNaN(idx) || idx < 1 || idx > 7) return;
            var enabled = (r.is_enable==1 || r.is_enable===true || r.is_enable=='1');
            $('#day_enable_'+idx).prop('checked', !!enabled);
            $('#bh_start_'+idx).val(r.start_time || '').prop('disabled', !enabled);
            $('#bh_end_'+idx).val(r.end_time || '').prop('disabled', !enabled);
          });
        }
 
        $('#editBusinessHours').on('click', function(){
          var $btn = $(this).prop('disabled', true);
          $.getJSON('api/get_horarios.php', function(resp){
            if (!resp.success) {
              $('#bhFeedback').html('<div class="alert alert-danger">Erro ao obter horários.</div>');
              $btn.prop('disabled', false);
              return;
            }
            populateBusinessHours(resp.data);
            $('#businessHoursForm').show();
            $('#cancelEditBH').removeClass('d-none');
            $btn.prop('disabled', false);
          }).fail(function(){
            $('#bhFeedback').html('<div class="alert alert-danger">Erro de comunicação ao obter horários.</div>');
            $btn.prop('disabled', false);
          });
        });

        $('#cancelEditBH').on('click', function(){
          $('#businessHoursForm').hide();
          $(this).addClass('d-none');
        });
        
        function loadHorarios(){
          $.getJSON('api/get_horarios.php', function(resp){
            var daysMap = {1:'Domingo',2:'Segunda-feira',3:'Terça-feira',4:'Quarta-feira',5:'Quinta-feira',6:'Sexta-feira',7:'Sábado'};
             if (!resp.success) {
               $('#horariosTable tbody').html('<tr><td colspan="4" class="text-center">Erro ao obter horários.</td></tr>');
               return;
             }
             if (!resp.data || resp.data.length === 0) {
               $('#horariosTable tbody').html('<tr><td colspan="4" class="text-center">Nenhum registo encontrado</td></tr>');
               return;
             }
             var rows = '';
             resp.data.forEach(function(r){
               var wk = (r.weekday == 0 || r.weekday == null) ? 1 : parseInt(r.weekday,10);
               var dayLabel = daysMap[wk] || wk;
              var isEnabled = (r.is_enable==1 || r.is_enable===true || r.is_enable=='1');
              var enabledLabel = isEnabled ? 'Sim' : 'Não';
              var start = r.start_time || '';
              var end = r.end_time || '';
              var rowClass = isEnabled ? '' : 'row-disabled';
              rows += '<tr class="'+rowClass+'"><td>'+escapeHtml(dayLabel)+'</td><td>'+enabledLabel+'</td><td>'+escapeHtml(start)+'</td><td>'+escapeHtml(end)+'</td></tr>';
             });
             $('#horariosTable tbody').html(rows);
           }).fail(function(){
             $('#horariosTable tbody').html('<tr><td colspan="4" class="text-center">Erro ao carregar horários.</td></tr>');
           });
         }

        // carregar ao abrir a página
        loadFolgas(); loadHorarios();
      });
    </script>

    <!-- Adicionar o modal após o conteúdo da aba folgas -->
<div class="modal fade" id="editFolgaModal" tabindex="-1" role="dialog" aria-labelledby="editFolgaModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editFolgaModalLabel">Editar Folga</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editFolgaForm" class="form">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="edit_cabeleireira">Cabeleireira</label>
                <select id="edit_cabeleireira" name="cabeleireira" class="form-control" required>
                  <option value="">Selecione a cabeleireira</option>
                  <?php
                    $sql="select * from terapeutas order by nome";
                    $stmt = sqlsrv_query($conn, $sql);
                    while ($r = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                        echo '<option value="'.$r['id'].'">'.$r['nome'].'</option>';
                    }
                  ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="edit_dias_semana">Dias da Semana</label>
                <div id="edit_dias_semana_group">
                  <?php
                    $dias = ['Domingo','Segunda-feira','Terça-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sábado'];
                    for($i=1;$i<=7;$i++){
                      echo '<div class="form-check">';
                      echo '<input class="form-check-input" type="checkbox" name="dias_semana[]" id="edit_ds_'.$i.'" value="'.$i.'">';
                      echo '<label class="form-check-label" for="edit_ds_'.$i.'">'.$dias[$i-1].'</label>';
                      echo '</div>';
                    }
                  ?>
                  <small class="small-muted">Marque vários dias conforme necessário.</small>
                </div>
              </div>
            </div>
          </div>
        </form>
        <div id="editFolgaFeedback" class="mt-2"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="confirmEditFolga">Editar Folga</button>
      </div>
    </div>
  </div>
</div>

</body>
</html>
<?php
