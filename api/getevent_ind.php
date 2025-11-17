<?php
include("../bd/conexao.php");

if (isset($_REQUEST['id'])) {
    $id=$_REQUEST['id'];

    $sql="SELECT * FROM events where id=$id";
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r("Erro codigo 1".sqlsrv_errors(), true));
    }
    while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
    {
        $id=$row["id"];
      
        $start=$row["start_event"]->format("Y-m-d H:i:s");
        $end=$row["end_event"]->format("Y-m-d H:i:s");

      

        $temp=explode(" ",$start);
        $data_inicio=$temp[0];
        $hora_inicio=$temp[1]; 
        $notas=$row["notas"];

        $temp=explode(" ",$end);
       
        $hora_fim=$temp[1]; 

        $data[] = [
            'id'              => $row["id"],
            'notas'           => $notas,
            'data_inicio'     => $data_inicio,
            'hora_fim'        => $hora_fim,
            'hora_inicio'     => $hora_inicio
        ];
    }
    echo json_encode($data);
}
?>