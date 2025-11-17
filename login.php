<?php
    session_start();

	include "bd/conexao.php";
	 
    date_default_timezone_set('Europe/Lisbon');
    error_reporting(E_ALL);
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
    <title>GE</title>
    <link rel="apple-touch-icon" href="app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="app-assets/images/ico/icon_vv.png">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/forms/icheck/icheck.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/forms/icheck/custom.css">
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
    <link rel="stylesheet" type="text/css" href="app-assets/css/pages/login-register.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->
<?php
if($_REQUEST["validar"]=="Validar Login")
{
    $utilizador=$_REQUEST["user"];
			$password=$_REQUEST["password"];
			
			$pass_enc=md5($password);
			
			/********************** vai ver se é um utilizador interno **********/
			$sql="SELECT  * from utilizadores where login='$utilizador' and password='$pass_enc'";
           // echo $sql."<br>";
           echo "aaa";
            $stmt = sqlsrv_query( $conn, $sql );
			if( $stmt === false) {
				die( print_r(sqlsrv_errors(), true) );
			}
			$cont=0;
          
			while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) 
			{
				$cont++;
				$nome= iconv('UTF-8','ISO-8859-1',$row["nome"]);
				$login=$row["login"];
				$email=$row["email"];
				$id=$row["id_user"];
				$perfil=$row["perfil"];
               
			
			}
			sqlsrv_free_stmt( $stmt);
			if($cont>0)
			{
               // $_SESSION["nome"]=	$nome;
                if (mb_detect_encoding($nome, 'UTF-8', true)==false) {
                    $_SESSION["nome"]=iconv('ISO-8859-1', 'UTF-8', $nome);
                } elseif (mb_detect_encoding($nome)=='ASCII') {
                    $_SESSION["nome"]=iconv('ISO-8859-1', 'UTF-8', $nome);
                } else {
                    $_SESSION["nome"]= $nome;
                }
			
				$_SESSION["email"]=	$email;
				$_SESSION["id"]=	$id;
             
                $_SESSION["perfil"]= $perfil;
               
                


                $_SESSION["login"]=$login;
				$_SESSION["registo"]=6892462158;
				
                $data_hora=date("Y/m/d H:i:s");

                print("<script type='text/javascript'> window.location='index.php';</script>");
				
            }
            else
            {
               print("<script type='text/javascript'> alert('Apenas utilizadores registados podem aceder a esta aplicação'); window.location='index.php';</script>");	
            }
			
						
			

}

?>
<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu 1-column   blank-page" data-open="hover" data-menu="horizontal-menu" data-col="1-column">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="row flexbox-container">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 m-0">
                                <div class="card-header border-0">
                                    <div class="card-title text-center">
                                        <div class="p-1"><span><u>Gestão de Equipamentos Informáticos - Vila Vita Parc</u></span></div>
                                    </div>
                                  
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form-horizontal form-simple" action="login.php" method="POST" novalidate>
                                            <fieldset class="form-group position-relative has-icon-left mb-0">
                                                <input type="text" class="form-control" id="user" name="user" placeholder="Utilizador" required>
                                                <div class="form-control-position">
                                                    <i class="la la-user"></i>
                                                </div>
                                            </fieldset>
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                                <div class="form-control-position">
                                                    <i class="la la-key"></i>
                                                </div>
                                            </fieldset>
                                            <input type="hidden" id="validar" name="validar" value="Validar Login">
                                            <button type="submit" class="btn btn-info btn-block"><i class="ft-unlock"></i> Login</button>
                                        </form>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="app-assets/vendors/js/ui/jquery.sticky.js"></script>
    <script src="app-assets/vendors/js/charts/jquery.sparkline.min.js"></script>
    <script src="app-assets/vendors/js/forms/icheck/icheck.min.js"></script>
    <script src="app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="app-assets/js/core/app-menu.js"></script>
    <script src="app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="app-assets/js/scripts/ui/breadcrumbs-with-stats.js"></script>
    <script src="app-assets/js/scripts/forms/form-login-register.js"></script>
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>