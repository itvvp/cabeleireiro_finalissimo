<?php
    session_start();

	include "bd/conexao.php";
	//include "sessao.php"; 
    date_default_timezone_set('Europe/Lisbon');
    error_reporting(E_ALL & ~E_NOTICE);
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Programa de segurança contra incêndios em edifícios - vila vita parc.">
    <meta name="author" content="Carlos Serranheira">
    <title>GC</title>
    <link rel="apple-touch-icon" href="app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="app-assets/images/ico/icon_vv.png">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700" rel="stylesheet">

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
    <!-- END: Custom CSS-->
    
    <!--****************************************-->
    <link href='packages/core/main.css' rel='stylesheet' />
    <link href='packages/daygrid/main.css' rel='stylesheet' />
    <link href='packages/timegrid/main.css' rel='stylesheet' />
    <link href='packages/list/main.css' rel='stylesheet' />
    <link href='packages/bootstrap/css/bootstrap.css' rel='stylesheet' />
    <link href="packages/jqueryui/custom-theme/jquery-ui-1.10.4.custom.min.css" rel="stylesheet">
    <link href='packages/datepicker/datepicker.css' rel='stylesheet' />
    <link href='packages/colorpicker/bootstrap-colorpicker.min.css' rel='stylesheet' />
    <link href='style.css' rel='stylesheet' />

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
    <script src='calendar5.js'></script>

    <script>
        

    </script>
</head>
<!-- END: Head-->
<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu 2-columns  " data-open="hover" data-menu="horizontal-menu" data-col="2-columns">

    <!-- BEGIN: Header-->
    <?php include "cabecalho.php"; ?>
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
<?php include "menu_cima.php"; ?>
    <!-- END: Main Menu-->
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        

        <div class="content-wrapper">
           
            <div class="content-body">
                <!-- users list start -->
                <section class="users-list-wrapper">
                    
                    <div class="users-list-table">
                    <div class="card">
                         
                        <div class="card-content mt-1">
                            <!-- ******* começa aqui ************ -->
                            <div class="modal fade" id="addeventmodal" tabindex="-1" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title">Adicionar Marcação Sara Sequeira</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">

                                            <div class="container-fluid">

                                                <form id="createEvent" class="form-horizontal">

                                                <div class="row">

                                                    <div class="col-md-12">

                                                        <div id="erro_inserir" name="erro_inserir" style="display:none;" class="alert alert-icon-left alert-danger alert-dismissible mb-2" role="alert">
                                                                <span class="alert-icon"><i class="la la-thumbs-o-down"></i></span>
                                                                
                                                                O horário que selecionou já não se encontra disponivel, por favor selecione outro horário 
                                                        </div>
                                                        <div id="erro_inserir_sem" name="erro_inserir_sem" style="display:none;" class="alert alert-icon-left alert-danger alert-dismissible mb-2" role="alert">
                                                            <span class="alert-icon"><i class="la la-thumbs-o-down"></i></span>
                                                            
                                                            O horário que selecionou não se encontra dísponivel por indisponibilidade da cabeleireira 
                                                        </div>

                                                        <div id="title-group" class="form-group">
                                                            <label class="control-label" for="title">Selecione o Tratamento</label>
                                                            <select class="form-control" id="tratamento" name="tratamento" required autocomplete="off">
                                                                <option>Selecione o tratamento</option>
                                                                <?php
                                                                    $sql4="select * from tratamentos order by tratamento";
                                                                    $stmt4 = sqlsrv_query($conn, $sql4);
                                                                    if ($stmt4 === false) {
                                                                        die(print_r(sqlsrv_errors(), true));
                                                                    }
                                                                    while ($row4 = sqlsrv_fetch_array($stmt4, SQLSRV_FETCH_ASSOC)) {
                                                                        $id_tratamento=$row4["id"];

                                                                        if (mb_detect_encoding($row4['tratamento'], 'UTF-8', true)==false) {
                                                                            $designacao=iconv('ISO-8859-1', 'UTF-8', $row4["tratamento"]);
                                                                        } elseif (mb_detect_encoding($row4['tratamento'])=='ASCII') {
                                                                            $designacao=iconv('ISO-8859-1', 'UTF-8', $row4["tratamento"]);
                                                                        } else {
                                                                            $designacao= $row4["tratamento"];
                                                                        } 
                                                                ?>
                                                                        <option value="<?php echo $id_tratamento;?>" ><?php echo $designacao;?></option>
                                                                <?php   } ?>      
                                                            </select>
                                                            <!-- errors will go here -->
                                                        </div>

                                                        <div class="card text-white box-shadow-0 bg-info">
                                                            <div class="card-header">
                                                                <h4 class="card-title text-white">Atenção</h4>
                                                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                                                
                                                            </div>
                                                            <div class="card-content collapse show">
                                                                <div class="card-body">
                                                                    <p class="card-text">Tem obrigatoriamente de selecionar a cabeleireira</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="title-group" class="form-group">
                                                            <label class="control-label" for="title">Selecione a cabeleireira</label>
                                                            <select class="form-control" id="cabeleireira" name="cabeleireira" required autocomplete="off">
                                                                <option value="1">Selecione a cabeleireira</option>
                                                                <?php
                                                                    $sql4="select * from terapeutas order by nome";
                                                                    $stmt4 = sqlsrv_query($conn, $sql4);
                                                                    if ($stmt4 === false) {
                                                                        die(print_r(sqlsrv_errors(), true));
                                                                    }
                                                                    while ($row4 = sqlsrv_fetch_array($stmt4, SQLSRV_FETCH_ASSOC)) {
                                                                        $id=$row4["id"];

                                                                        if (mb_detect_encoding($row4['nome'], 'UTF-8', true)==false) {
                                                                            $designacao=iconv('ISO-8859-1', 'UTF-8', $row4["nome"]);
                                                                        } elseif (mb_detect_encoding($row4['nome'])=='ASCII') {
                                                                            $designacao=iconv('ISO-8859-1', 'UTF-8', $row4["nome"]);
                                                                        } else {
                                                                            $designacao= $row4["nome"];
                                                                        } 
                                                                ?>
                                                                        <option value="<?php echo $id;?>" ><?php echo $designacao;?></option>
                                                                <?php   } ?>      
                                                            </select>
                                                            <!-- errors will go here -->
                                                        </div>

                                                        <div id="edit-title-group" class="form-group">
                                                            <label class="control-label" for="NomeHospede">Insira o nome do(a) hóspede</label>
                                                            <input type="text" class="form-control" id="NomeHospede" required name="NomeHospede" autocomplete="off">
                                                            <!-- errors will go here -->
                                                        </div>

                                                        <div id="edit-title-group" class="form-group">
                                                            <label class="control-label" for="QuartoHospede">Insira o quarto do(a) hóspede</label>
                                                            <input type="text" class="form-control" id="QuartoHospede"  name="QuartoHospede" autocomplete="off">
                                                            <!-- errors will go here -->
                                                        </div>

                                                        <div id="edit-title-group" class="form-group">
                                                            <label class="control-label" for="NotasHospede">Notas do tratamento</label>
                                                            <textarea name="NotasHospede" class="form-control textarea-maxlength" id="NotasHospede"  maxlength="250" rows="5"></textarea>
                                                            <!-- errors will go here -->
                                                        </div>



                                                        <div id="startdate-group" class="form-group">
                                                            <label class="control-label" for="startDate">Data do tratamento</label>
                                                            <input type="date" class="form-control" id="startDate" required name="startDate" autocomplete="off"> 
                                                           
                                                            <!-- errors will go here -->
                                                        </div>

                                                        <div id="startdate-group" class="form-group">
                                                            <label class="control-label" for="enddate_inserir">Data Fim para o tratamento</label>
                                                            <input type="date" class="form-control" id="enddate_inserir"  name="enddate_inserir" autocomplete="off"> 
                                                            <span style="color:blue;font-syze:10px">Caso queira repetir o tratamento para mais dias selecione a data de fim do tratamento</span>
                                                            <!-- errors will go here -->
                                                        </div>
                                                      

                                                        <div id="startdate-group" class="form-group">
                                                            <label class="control-label" for="startTime">Hora de inicio do tratamento</label>
                                                            <input type="time" class="form-control" id="startTime" required name="startTime" autocomplete="off"> 
                                                            <!-- errors will go here -->
                                                        </div>

                                                        

                                                    </div>

                                                    
                                                </div>

                                                

                                            </div>

                                        </div>

                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                        <button type="submit" class="btn btn-primary">Gravar Dados</button>
                                        </div>

                                        </form>

                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->

                            <div class="modal fade" id="editeventmodal" tabindex="-1" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title">Editar Marcação</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">

                                            <div class="container-fluid">

                                                <form id="editEvent" class="form-horizontal">
                                                <input type="hidden" id="editEventId" name="editEventId" value="">

                                                <div class="row">

                                                <div class="col-md-12">
                                                    
                                                    <div id="erro_editar" name="erro_editar" style="display:none;" class="alert alert-icon-left alert-danger alert-dismissible mb-2" role="alert">
                                                        <span class="alert-icon"><i class="la la-thumbs-o-down"></i></span>
                                                        
                                                        O horário que selecionou já não se encontra disponivel, por favor selecione outro horário 
                                                    </div>

                                                    <div id="erro_editar_sem" name="erro_editar_sem" style="display:none;" class="alert alert-icon-left alert-danger alert-dismissible mb-2" role="alert">
                                                        <span class="alert-icon"><i class="la la-thumbs-o-down"></i></span>
                                                        
                                                        O horário que selecionou não se encontra dísponivel por indisponibilidade da cabeleireira 
                                                    </div>
                    
                                                    
                                                    
                                                    <div id="title-group" class="form-group">
                                                        <label class="control-label" for="tratamento_editar">Tratamento Selecionado</label>
                                                        <input type="text" class="form-control" disabled  id="tratamento_editar" required name="tratamento_editar" autocomplete="off">
                                                        <!-- errors will go here -->
                                                    </div>

                                                    <div id="title-group" class="form-group">
                                                            <label class="control-label" for="title">Selecione a cabeleireira</label>
                                                            <select class="form-control" id="cabeleireira" name="cabeleireira" required autocomplete="off">
                                                                <option>Selecione a cabeleireira</option>
                                                                <?php
                                                                    $sql4="select * from terapeutas order by nome";
                                                                    $stmt4 = sqlsrv_query($conn, $sql4);
                                                                    if ($stmt4 === false) {
                                                                        die(print_r(sqlsrv_errors(), true));
                                                                    }
                                                                    while ($row4 = sqlsrv_fetch_array($stmt4, SQLSRV_FETCH_ASSOC)) {
                                                                        $id=$row4["id"];

                                                                        if (mb_detect_encoding($row4['nome'], 'UTF-8', true)==false) {
                                                                            $designacao=iconv('ISO-8859-1', 'UTF-8', $row4["nome"]);
                                                                        } elseif (mb_detect_encoding($row4['nome'])=='ASCII') {
                                                                            $designacao=iconv('ISO-8859-1', 'UTF-8', $row4["nome"]);
                                                                        } else {
                                                                            $designacao= $row4["nome"];
                                                                        } 
                                                                ?>
                                                                        <option value="<?php echo $id;?>" ><?php echo $designacao;?></option>
                                                                <?php   } ?>      
                                                            </select>
                                                            <!-- errors will go here -->
                                                        </div>

                                                    <div id="edit-title-group" class="form-group">
                                                        <label class="control-label" for="nomehospede">Insira o nome do(a) hóspede</label>
                                                        <input type="text" class="form-control" id="nomehospede" required name="nomehospede" autocomplete="off">
                                                        <!-- errors will go here -->
                                                    </div>

                                                    <div id="edit-title-group" class="form-group">
                                                        <label class="control-label" for="quartohospede">Insira o quarto do(a) hóspede</label>
                                                        <input type="text" class="form-control" id="quartohospede"  name="quartohospede" autocomplete="off">
                                                        <!-- errors will go here -->
                                                    </div>

                                                    <div id="edit-title-group" class="form-group">
                                                        <label class="control-label" for="notashospede">Notas do tratamento</label>
                                                        <textarea name="notashospede" class="form-control textarea-maxlength" id="notashospede"  maxlength="250" rows="5"></textarea>
                                                        <!-- errors will go here -->
                                                    </div>



                                                    <div id="startdate-group" class="form-group">
                                                        <label class="control-label" for="startdate">Data do tratamento</label>
                                                        <input type="date" class="form-control" id="startdate" required name="startdate" autocomplete="off"> 
                                                        <!-- errors will go here -->
                                                    </div>

                                                    <div id="startdate-group" class="form-group">
                                                        <label class="control-label" for="starttime">Hora de inicio do tratamento</label>
                                                        <input type="time" class="form-control" id="starttime" required name="starttime" autocomplete="off"> 
                                                        <!-- errors will go here -->
                                                    </div>



                                                </div>


                                                </div>

                                            </div>

                                        </div>

                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                        <button type="submit" class="btn btn-primary">Gravar Alterações</button>
                                        <button type="button" class="btn btn-danger" id="deleteEvent" data-id>Apagar Marcação</button>
                                        </div>

                                        </form>

                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->

                            <div class="container">

                              

                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addeventmodal">
                                Adicionar Marcação
                                </button>

                                <div id="calendar"></div>
                            </div>

                            <!-- ******* finaliza aqui ********** -->
                        </div>
                        </div>
                    </div>
                </section>
                <!-- users list ends -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
   <?php include "rodape_novo.php"; ?>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
  <!-- <script src="app-assets/vendors/js/vendors.min.js"></script> -->
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="app-assets/vendors/js/ui/jquery.sticky.js"></script>
    <script src="app-assets/vendors/js/charts/jquery.sparkline.min.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="app-assets/js/core/app-menu.js"></script>
    <script src="app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="app-assets/js/scripts/ui/breadcrumbs-with-stats.js"></script>
    <script src="app-assets/js/scripts/pages/page-users.js"></script>
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>