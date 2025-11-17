<?php
include("../bd/conexao.php");

if (isset($_POST["id"])) {
  $id=$_POST["id"];
  $sql="delete from events where id=$id";
        $stmt = sqlsrv_query($conn, $sql);
        if ($stmt === false) {
            die(print_r("Erro codigo 1".sqlsrv_errors(), true));
        }
    
}
?>