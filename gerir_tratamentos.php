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
    
<script language= 'javascript'>

function aviso1(id)
{
        if(confirm (' Deseja realmente apagar este tratamento? '))
        {
                        
            location.href="gerir_tratamentos.php?apaga=1&id="+id;
        }
        else
        {
            return false;
        }
}

function aviso2(id)
{
        if(confirm (' Deseja realmente editar este tratamento? '))
        {
                        
            location.href="gerir_tratamentos.php?edita=1&id="+id;
        }
        else
        {
            return false;
        }
}


//-->
</script>   



</head>
<!-- END: Head-->
<?php
if (isset($_REQUEST["apaga"])) {
    if ($_REQUEST["apaga"]=="1") {
        $id=$_REQUEST["id"];


        $sql="delete from tratamentos where id=$id";
        $stmt = sqlsrv_query($conn, $sql);
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        print("<script type='text/javascript'> alert('Os seus dados foram apagados com sucesso'); window.location='gerir_tratamentos.php';</script>");	

    }
}

if(isset($_REQUEST["gravar"]))
{
    if($_REQUEST["gravar"]=="gravar dados")
    {
        //$tipo=$_REQUEST["tipo"];
        if (mb_detect_encoding($_REQUEST["tratamento"], 'UTF-8', true)==false) {
            $tratamento=iconv('ISO-8859-1', 'UTF-8', $_REQUEST["tratamento"]);
        } elseif (mb_detect_encoding($_REQUEST["tratamento"])=='ASCII') {
            $tratamento=iconv('ISO-8859-1', 'UTF-8', $_REQUEST["tratamento"]);
        } else {
            $tratamento= $_REQUEST["tratamento"];
        }

     
        $duracao=$_REQUEST["duracao"];
        $preco=$_REQUEST["preco"];
       
		$sql2="select count(*) as total from tratamentos where tratamento='$tratamento' and duracao='$duracao' and preco='$preco'";
        $stmt2 = sqlsrv_query( $conn, $sql2 );
        if( $stmt2 === false) {
            die( print_r("Erro sem ficheiro".sqlsrv_errors(), true) );
        }
        $row2 = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC);
        $numero_logins=$row2["total"];
       
        if($numero_logins>0)
        {
            print("<script type='text/javascript'> alert('Já existe um tratamento com esses dados no sistema'); window.location='gerir_tratamentos.php';</script>");	

        }
        else
        {
            $sql2="insert into tratamentos(tratamento,duracao,preco) values('$tratamento','$duracao','$preco')";
           // echo $sql2;
            $stmt2 = sqlsrv_query( $conn, $sql2 );
            if( $stmt2 === false) {
                die( print_r("Erro sem ficheiro".sqlsrv_errors(), true) );
            }
            print("<script type='text/javascript'> alert('Os dados do tratamento foram inseridos com sucesso'); window.location='gerir_tratamentos.php';</script>");	
        }



    }

    if($_REQUEST["gravar"]=="editar dados")
    {
        //$tipo=$_REQUEST["tipo"];
        if (mb_detect_encoding($_REQUEST["tratamento"], 'UTF-8', true)==false) {
            $tratamento=iconv('ISO-8859-1', 'UTF-8', $_REQUEST["tratamento"]);
        } elseif (mb_detect_encoding($_REQUEST["tratamento"])=='ASCII') {
            $tratamento=iconv('ISO-8859-1', 'UTF-8', $_REQUEST["tratamento"]);
        } else {
            $tratamento= $_REQUEST["tratamento"];
        }

        $id=$_REQUEST["id"];
     
        $duracao=$_REQUEST["duracao"];
        $preco=$_REQUEST["preco"];
       
	
            $sql2="update tratamentos set tratamento='$tratamento' ,duracao='$duracao' ,preco='$preco' where id=$id";
           // echo $sql2;
            $stmt2 = sqlsrv_query( $conn, $sql2 );
            if( $stmt2 === false) {
                die( print_r("Erro sem ficheiro".sqlsrv_errors(), true) );
            }
            print("<script type='text/javascript'> alert('Os dados do tratamento foram atualizados com sucesso'); window.location='gerir_tratamentos.php';</script>");	
        



    }

}



?>
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
                                        <h1>Lista de tratamentos disponiveis</h1>
                                        
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
                <section id="configuration">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <!-- datatable start -->
                                    <?php
                                    if ($_REQUEST["inserir"]==1) {
                                        ?>
                                    <form class="form" autocomplete="off" action="gerir_tratamentos.php" method="post" enctype="multipart/form-data">
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-user"></i>Insira os dados do tratamento</h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="tratamento">Nome tratamento</label>
                                                            <input type="text" id="tratamento" required class="form-control" placeholder="Insira o nome do tratamento" name="tratamento">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="duracao">Duração Tratamento</label>
                                                            <input type="time" id="duracao" required class="form-control"  name="duracao">
                                                        </div>
                                                    </div>
                                                    
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="preco">Preço Tratamento</label>
                                                            <input type="text" id="preco" required class="form-control"  name="preco">
                                                        </div>
                                                    </div>
                                                   
                                                    
                                                </div>

                                               
                                                
                                                             
                                                
                                            </div>
                                            <input type="hidden" name="gravar" id="gravar" value="gravar dados" >                           
                                            <div class="form-actions" style="text-align: center;">
                                                <button type="button" class="btn btn-warning mr-1">
                                                    <i class="ft-x"></i> Cancelar
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> Gravar Dados
                                                </button>
                                            </div>
                                        </form>
                                        <br>
                                        <?php
                                        }
                                        ?>

<?php
                                    if ($_REQUEST["edita"]==1) {
                                        $id=$_REQUEST["id"];
                                        $sql="select * from tratamentos where id=$id";
                                        $stmt = sqlsrv_query( $conn, $sql );
                                        if( $stmt === false) {
                                            die( print_r(sqlsrv_errors(), true) );
                                        }
                                        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
                                            
                                        if (mb_detect_encoding($row['tratamento'], 'UTF-8', true)==false) {
                                            $tratamento=iconv('ISO-8859-1', 'UTF-8', $row["tratamento"]);
                                        } elseif (mb_detect_encoding($row['tratamento'])=='ASCII') {
                                            $tratamento=iconv('ISO-8859-1', 'UTF-8', $row["tratamento"]);
                                        } else {
                                            $tratamento= $row["tratamento"];
                                        }

                                        $duracao=$row["duracao"]->Format("H:i");
                                        $preco=$row["preco"];
                                        ?>
                                    <form class="form" autocomplete="off" action="gerir_tratamentos.php" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="id" id="id" value="<?php echo $id;?>" >    
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-user"></i>Insira os dados do tratamento</h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="tratamento">Nome tratamento</label>
                                                            <input type="text" id="tratamento" required class="form-control" value="<?php echo $tratamento; ?>" placeholder="Insira o nome do tratamento" name="tratamento">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="duracao">Duração Tratamento</label>
                                                            <input type="time" id="duracao" required class="form-control" value="<?php echo $duracao; ?>"  name="duracao">
                                                        </div>
                                                    </div>
                                                    
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="preco">Preço Tratamento</label>
                                                            <input type="text" id="preco" required class="form-control" value="<?php echo $preco; ?>"  name="preco">
                                                        </div>
                                                    </div>
                                                   
                                                    
                                                </div>

                                               
                                                
                                                             
                                                
                                            </div>
                                            <input type="hidden" name="gravar" id="gravar" value="editar dados" >                           
                                            <div class="form-actions" style="text-align: center;">
                                                <button type="button" class="btn btn-warning mr-1">
                                                    <i class="ft-x"></i> Cancelar
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> Gravar Dados
                                                </button>
                                            </div>
                                        </form>
                                        <br>
                                        <?php
                                        }
                                        ?>
                                    <!-- datatable ends -->
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered zero-configuration">
                                                <thead>
                                                    <tr>
                                                        <th>Tratamento</th>
                                                        <th>Duração</th>
                                                        <th>Preço</th>
                                                     
                                                        <th>Editar</th>
                                                        <th>Apagar</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $sql="SELECT * from tratamentos order by tratamento";
                                                $stmt = sqlsrv_query( $conn, $sql );
                                                if( $stmt === false) {
                                                    die( print_r(sqlsrv_errors(), true) );
                                                }
                                                while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                                                    
                                                    if (mb_detect_encoding($row['tratamento'], 'UTF-8', true)==false) {
                                                        $tratamento=iconv('ISO-8859-1', 'UTF-8', $row["tratamento"]);
                                                    } elseif (mb_detect_encoding($row['tratamento'])=='ASCII') {
                                                        $tratamento=iconv('ISO-8859-1', 'UTF-8', $row["tratamento"]);
                                                    } else {
                                                        $tratamento= $row["tratamento"];
                                                    }

                                                    $id=$row["id"];
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $tratamento; ?></td>
                                                      
                                                        <td><?php echo $row["duracao"]->Format("H:i"); ?></td>
                                                        <td><?php echo $row["preco"]; ?></td>
                                                        <td align="center"><a href="javascript:aviso2('<?php echo $row["id"];?>');"><i class="la la-edit"></i></a></td>
                                                        <td align="center"><a href="javascript:aviso1('<?php echo $row["id"];?>');"><i class="la la-times"></i></a></td>
                                                    </tr>
                                                    <?php
                                                        }
                                                    ?>
                                                </tbody>
                                               <br>
                                              
                                            </table>
                                            <div style="text-align: center;">
                                                <a href="gerir_tratamentos.php?inserir=1"> <button type="button" class="btn btn-primary"> <i class="la la-check-square-o"></i> Inserir Novo Tratamento</button></a>
                                            </div>
                                        </div>
                                    </div>
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