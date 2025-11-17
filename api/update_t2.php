<?php
include("../bd/conexao.php");
session_start();
if (isset($_POST['id'])) {

    //collect data
    $error      = null;
    $id         = $_REQUEST['id'];
    $nomehospede = $_REQUEST['nomehospede'];
    $quartohospede = $_REQUEST['quartohospede'];
    $notashospede = $_REQUEST['notashospede'];
    $startdate = $_REQUEST['startdate'];
    $starttime = $_REQUEST['starttime'];



    //optional fields
   

    //validation
    if ($nomehospede == '') {
        $error['NomeHospede'] = 'A seleção do Nome do Hospede é obrigatória';
    }

    if ($startdate == '') {
        $error['start'] = 'Insira a data para o inicio do tratamento';
    }

    if ($starttime == '') {
        $error['startTime'] = 'A hora de ínicio do tratamento é obrigatória';
    }

    //if there are no errors, carry on
    if (! isset($error)) {

        $sql="select * from events where id=$id";
        // echo $sql."<br>";
         $stmt = sqlsrv_query($conn, $sql);
         if ($stmt === false) {
             die(print_r("Erro 1".sqlsrv_errors(), true));
         }
         $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
         $start_event=$row["start_event"]->format('Y-m-d H:i:s');
         $end_event=$row["end_event"]->format('Y-m-d H:i:s');
         $id_tratamento=$row["id_tratamento"];

        $sql="select * from tratamentos where id=$id_tratamento";
        // echo $sql."<br>";
         $stmt = sqlsrv_query($conn, $sql);
         if ($stmt === false) {
             die(print_r("Erro 2".sqlsrv_errors(), true));
         }
         $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
         $duracao_h=$row["duracao"]->format("H");
         $duracao_m=$row["duracao"]->format("i");
 
         
        
         if (mb_detect_encoding($row['tratamento'], 'UTF-8', true)==false) {
             $designacao=iconv('ISO-8859-1', 'UTF-8', $row["tratamento"]);
         } elseif (mb_detect_encoding($row['tratamento'])=='ASCII') {
             $designacao=iconv('ISO-8859-1', 'UTF-8', $row["tratamento"]);
         } else {
             $designacao= $row["tratamento"];
         } 
 
        
         $title = $designacao." - ".$NomeHospede;
 
        
         $data_hora_i=$startdate." ".$starttime;
         $data_hora_i_c= $data_hora_i;
      
 
         $d2 = "+ $duracao_h hours"; // Tempo esperado para finalizar o atendimento
         $d3 = "+ $duracao_m minutes"; 
 
    
 
         $data_hora_f = strtotime($data_hora_i_c . $d2 .$d3);
         $data_hora_f=date('Y-m-d H:i:s', $data_hora_f);
 

       // echo $id."<br><br>";
         
         $sql="select count(*) as total from events where (('$data_hora_i_c'>start_event and '$data_hora_i_c'<end_event) or ('$data_hora_f'>start_event and '$data_hora_f'<end_event)) and id_tratamento!=9999 and cabeleireira='2' and id!=$id";
     //   echo $sql."<br><br>";
        $stmt = sqlsrv_query($conn, $sql);
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        $numero_registos=$row["total"];
        
        if($perfil!=2)
        {
            $sql="select count(*) as total from events where (('$data_hora_i_c'>start_event and '$data_hora_i_c'<end_event) or 
            ('$data_hora_f'>start_event and '$data_hora_f'<end_event)) and cabeleireira='2' and id_tratamento=9999";
            $stmt = sqlsrv_query($conn, $sql);
            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            $numero_impedimentos=$row["total"];
        }
        else
        {
            $numero_impedimentos=0;
        }

        


         if($data_hora_i_c== $start_event and $data_hora_f== $end_event)
            $numero_registos=0;


         if ($numero_registos>0) {
             $error['totalRegistos'] = 'O horário que definiu para o tratamento já se encontra ocupado';
             $data['success'] = false;
             $data['errors'] = $error;
         } 
         else{
            if ($numero_impedimentos>0) {
                $error['totalImpedimentos'] = 'O horário que definiu não se encontra disponivel por indisponibilidade da cabeleireira';
                $data['success'] = false;
                $data['errors'] = $error;
            } 
            else{
                $sql="update events set start_event='$data_hora_i_c' ,end_event='$data_hora_f' ,nome_hospede='$nomehospede' ,quarto='$quartohospede' ,notas='$notashospede' where id=$id";
                
                // echo $sql."<br>";
                $stmt = sqlsrv_query($conn, $sql);
                if ($stmt === false) {
                    die(print_r("Erro 4".sqlsrv_errors(), true));
                }
    
                $data['success'] = true;
                $data['message'] = 'Success!';
            } 
         }    
      
    } else {

        $data['success'] = false;
        $data['errors'] = $error;
    }

    echo json_encode($data);
}
?>