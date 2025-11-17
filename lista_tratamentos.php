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
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/tables/datatable/datatables.min.css">
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
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- users list start -->
                <section class="users-list-wrapper">
                    
                    <div class="users-list-table">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <!-- datatable start -->
                                    <div style="text-align:center;">
                                        <h1>Lista de tratmentos disponiveis</h1>
                                        
                                    </div>
                                    <!-- datatable ends -->
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- users list ends -->
            </div>
        </div>

        <div class="content-wrapper">
            <div class="content-header row">
                
            </div>
            <div class="content-body">
                <!-- users list start -->
                <section class="users-list-wrapper">
                    
                    <div class="users-list-table">
                    <div class="card">
                           
                            
                            <?php
                               

                                $sql="select count(*) as total from tratamentos";
                                $stmt = sqlsrv_query($conn, $sql);
                                if ($stmt === false) {
                                    die(print_r("Erro codigo 1".sqlsrv_errors(), true));
                                }
                                $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
                                $total=$row["total"];
                                
                            ?>
                            <div class="card-content mt-1">
                                <div class="table-responsive">
                                    <table id="recent-orders" class="table table-hover table-xl mb-0">
                                        <thead>
                                            <tr>
                                                <th class="border-top-0">Descrição</th>
                                                <th class="border-top-0">Duração</th>
                                                <th class="border-top-0">Preço</th>
                                                
                                               
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                           
                                            if($total==0)
                                            {
                                            ?>
                                                <tr>
                                                    <td colspan="3">
                                                        <div class="alert alert-icon-left alert-danger alert-dismissible mb-2" role="alert">
                                                            <span class="alert-icon"><i class="la la-thumbs-o-down"></i></span>
                                                            
                                                            Não existem tratamentos inseridos no sistema
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            else
                                            {
                                                
                                                $sql="SELECT * from tratamentos order by tratamento";
                                                $stmt = sqlsrv_query($conn, $sql);
                                                if ($stmt === false) {
                                                    die(print_r(sqlsrv_errors(), true));
                                                }
                                                while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                                                     
                                                    if (mb_detect_encoding($row['tratamento'], 'UTF-8', true)==false) {
                                                        $tratamento=iconv('ISO-8859-1', 'UTF-8', $row["tratamento"]);
                                                    } elseif (mb_detect_encoding($row['tratamento'])=='ASCII') {
                                                        $tratamento=iconv('ISO-8859-1', 'UTF-8', $row["tratamento"]);
                                                    } else {
                                                        $tratamento= $row["tratamento"];
                                                    }   

                                                    if($row["duracao"]!="")
                                                        $duracao=$row["duracao"]->Format("H:i");
                                                    else    
                                                        $duracao="Sem duração inserida";
                                                    
                                                    $preco=$row["preco"]." €";
                                                   
                                                ?>   
                                                    
                                                    <tr>
                                                        
                                                        <td class="text-truncate"><?php echo $tratamento; ?></td>
                                                        <td class="text-truncate"><?php echo $duracao; ?></td>
                                                        <td class="text-truncate"><?php echo $preco; ?></td>
                                                      
                                                    </tr>
                                                   
                                           <?php
                                                }  
                                            }
                                            ?>

                                           
                                        </tbody>
                                    </table>
                                </div>
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
    <script src="app-assets/vendors/js/vendors.min.js"></script>
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