<?php session_start();
	  
?>
<?php

	unset($_SESSION['nome']); 
	unset($_SESSION['perfil']); 
	unset($_SESSION['departamento']); 
	unset($_SESSION['login']);
	unset($_SESSION['registo']);
					
	
		
	session_destroy();
			
	print("<script type='text/javascript'> window.location='index.php';</script>");
			
			
?>
