
<?php

/**************** conexão ao nosso servidor ***************************/
/*$servername="ARMONA\SQLEXPRESS";

$connectionInfo=array( "UID"=>"desporto",
                         "PWD"=>"glorioso",
                         "Database"=>"Campeonato_Nacional");
$conn=sqlsrv_connect($servername,$connectionInfo);

if($conn)
{
	
}
else
{
	echo "erro";
	die(print_r(sqlsrv_errors(),true));
}

*/

/*************************conexao ao servidor da DGE *******************/
$servername1="192.168.20.203";

$connectionInfo1=array( "UID"=>"ge1",
                         "PWD"=>"Vilavita2016",
                         "Database"=>"cabeleireiro",
                         "CharacterSet"=>"UTF-8");
$conn=sqlsrv_connect($servername1,$connectionInfo1);

if($conn)
{
	
}
else
{
	echo "erro1";
	die(print_r(sqlsrv_errors(),true));
}




?>
