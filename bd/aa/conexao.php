<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
//$servidor = "localhost"; /*maquina a qual o banco de dados está*/
//$usuario = "drealgne_carlosm"; /*usuario do banco de dados MySql*/
//$senha = "DQETNC7ofv$F"; /*senha do banco de dados MySql*/
$banco = "drealgne_desporto"; /*seleciona o banco a ser usado*/

$conexao = mysql_pconnect($servidor,$usuario,$senha);  /*Conecta no bando de dados MySql*/

mysql_select_db($banco); /*seleciona o banco a ser usado*/

?>
</body>
</html>