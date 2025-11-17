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
        $title=$row["title"];
        $start=$row["start_event"]->format("Y-m-d H:i:s");
        $id_tratamento=$row["id_tratamento"];

        $nome_hospede=$row["nome_hospede"];
        $quarto=$row["quarto"];
        $notas=$row["notas"];

        $sql1="select tratamento from tratamentos where id=$id_tratamento";
        $stmt1 = sqlsrv_query($conn, $sql1);
        if ($stmt1 === false) {
            die(print_r("Erro codigo 1".sqlsrv_errors(), true));
        }
        $row1 = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC);

        
        if (mb_detect_encoding($row1['tratamento'], 'UTF-8', true)==false) {
            $designacao=iconv('ISO-8859-1', 'UTF-8', $row1["tratamento"]);
        } elseif (mb_detect_encoding($row1['tratamento'])=='ASCII') {
            $designacao=iconv('ISO-8859-1', 'UTF-8', $row1["tratamento"]);
        } else {
            $designacao= $row1["tratamento"];
        } 

      //  $temp=explode("-",$title);
     //   $nome_hospede=trim($temp[1]);

        $temp=explode(" ",$start);
        $data_inicio=$temp[0];
        $hora_inicio=$temp[1]; 

        $data[] = [
            'id'              => $row["id"],
            'id_tratamento'   => $id_tratamento,
            'tratamento'      => $designacao,
            'nome_hospede'    => $nome_hospede,
            'quarto'          => $quarto,
            'notas'           => $notas,
            'data_inicio'     => $data_inicio,
            'hora_inicio'     => $hora_inicio
        ];
    }
    echo json_encode($data);
}
?>