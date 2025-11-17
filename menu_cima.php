<?php
    session_start();

	include "bd/conexao.php";
	
    date_default_timezone_set('Europe/Lisbon');
   
?>
    <div class="header-navbar navbar-expand-sm navbar navbar-horizontal navbar-fixed navbar-dark navbar-without-dd-arrow navbar-shadow" role="navigation" data-menu="menu-wrapper">
        <div class="navbar-container main-menu-content" data-menu="menu-container">
            <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="nav-item" ><a class="dropdown-toggle nav-link" href="index.php" ><i class="la la-calendar"></i><span data-i18n="Página Inicial<">Agenda Anita Oliveira</span></a></li>
                <li class="nav-item" ><a class="dropdown-toggle nav-link" href="index_s.php" ><i class="la la-calendar"></i><span data-i18n="Página Inicial<">Agenda Sara Sequeira</span></a></li>
                <li class="nav-item" ><a class="dropdown-toggle nav-link" href="lista_tratamentos.php" ><i class="la la-list-alt"></i><span data-i18n="Lista Tratamentos<">Lista Tratamentos</span></a></li>
                <?php
                 if ($_SESSION["registo"]=='6892462158') {
                ?>
                    <li class="nav-item" ><a class="dropdown-toggle nav-link" href="reservas.php" ><i class="la la-calendar"></i><span data-i18n="Gerir Reservas<">Gerir Reservas</span></a></li>
                   
                    <?php
                    if ($_SESSION["perfil"]==1 or $_SESSION["perfil"]==2) {
                        ?>
                        <li class="nav-item" ><a class="dropdown-toggle nav-link" href="indesp.php" ><i class="la la-calendar-times-o"></i><span data-i18n="Gerir Horário<">Gerir Horário</span></a></li>
                        <li class="nav-item" ><a class="dropdown-toggle nav-link" href="gerir_tratamentos.php" ><i class="la la-wrench"></i><span data-i18n="Gerir Tratamentos<<">Gerir Tratamentos</span></a></li>
                <?php
                    }
                }
                ?>   
                    
                

               
                
                 
            </ul>
        </div>
    </div>
