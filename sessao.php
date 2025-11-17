<?php
	
	if( $_SESSION['registo'] <> 693262158  )
	{
		
		print("<script type='text/javascript'> alert('Apenas utilizadores registados podem aceder a esta aplicação'); window.location='index.php';</script>");
		
	}


?>