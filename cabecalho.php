
<style type="text/css">
       @media(max-width:767px){
            .image1 {
                display: block!important; 
            }
            .image2 {
                display: none !important; 
            }
        }
    </style>
<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow navbar-static-top navbar-light navbar-brand-center">
        <div class="navbar-wrapper">
            <div class="navbar-header">
                <ul class="nav navbar-nav flex-row">
                    <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
                    <li class="nav-item"><a class="navbar-brand" href="index.php">
                          <!--  <h3 class="brand-text">Gestão Cabeleireiro - Vila Vita Parc</h3>-->
                            <div id="imagem_cabecalho" >  
                                <img class="image1" src="images/imagem_inicio.png" alt="Vila Vita Parc">
                                <img class="image2" src="images/logo_cabeleireiro.png" alt="Vila Vita Parc" style="padding-left: 20px;">
                            </div>
                        </a></li>
                    <li class="nav-item d-md-none"><a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a></li>
                </ul>
            </div>
            <div class="navbar-container content" >
                <div class="collapse navbar-collapse" id="navbar-mobile">
                    <ul class="nav navbar-nav mr-auto float-left">
                        <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu"></i></a></li>
                        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand" href="#"><i class="ficon ft-maximize"></i></a></li>
                       
                    </ul>
                    <ul class="nav navbar-nav float-right" style="left:35% !important;">
                    
                        <?php
                            if ($_SESSION["registo"]=='6892462158') {
                               /* $utilizador=$_SESSION["nome"];
                                $hora = date('H');
                                $mensagem="";
                                if ($hora >= 6 && $hora <= 12) {
                                    $mensagem='Bom dia';
                                } elseif ($hora > 12 && $hora <=18) {
                                    $mensagem='Boa tarde';
                                } else {
                                    $mensagem='Boa noite';
                                }*/ ?>
                                <li class="dropdown dropdown-user nav-item"><span class="mr-1 user-name text-bold-700"> </span>
                                    <a href="sair.php" data-toggle=""><i class="la la-sign-out"></i></a>
                                </li>
                        <?php
                            }
                            else
                            {
                        ?>
                            <li class="dropdown dropdown-user nav-item">
                                <a href="login.php" data-toggle=""><i class="la la-key"></i></a>
                            </li>
                        <?php        
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </nav>