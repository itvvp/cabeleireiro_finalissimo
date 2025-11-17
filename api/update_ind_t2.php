<?php
include("../bd/conexao.php");

if (isset($_POST['id'])) {

    //collect data
    $error      = null;
    $id         = $_REQUEST['id'];
    $startdate_editar = $_REQUEST['startdate_editar'];
    $starttime_editar = $_REQUEST['starttime_editar'];
    $endtime_editar = $_REQUEST['endtime_editar'];
    $notashospede = $_REQUEST['notashospede'];
    //optional fields
//   echo  $startdate_editar." ".$starttime_editar." ".$endtime_editar."<br>";


    //if there are no errors, carry on
    if (! isset($error)) {

        $sql="select * from events where id=$id";
       //  echo $sql."<br>";
         $stmt = sqlsrv_query($conn, $sql);
         if ($stmt === false) {
             die(print_r("Erro 1".sqlsrv_errors(), true));
         }
         $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
         $start_event=$row["start_event"]->format('Y-m-d H:i:s');
         $end_event=$row["end_event"]->format('Y-m-d H:i:s');
      
        
         $data_hora_i=$startdate_editar." ".$starttime_editar;
         $data_hora_i_c= $data_hora_i;
      
         $data_hora_f=$startdate_editar." ".$endtime_editar;

        
         
         $sql="select count(*) as total from events where ('$data_hora_i_c'>start_event and '$data_hora_i_c'<end_event) or 
        ('$data_hora_f'>start_event and '$data_hora_f'<end_event) and id_tratamento!=9999 and cabeleireira='2' and id!=$id";
        $stmt = sqlsrv_query($conn, $sql);
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        $numero_registos=$row["total"];


         if($data_hora_i_c== $start_event and $data_hora_f== $end_event)
            $numero_registos=0;


         if ($numero_registos>0) {
             $error['totalRegistos'] = 'O horário que definiu para o tratamento já se encontra ocupado';
             $data['success'] = false;
             $data['errors'] = $error;
         } 
         else{
           
                $sql="update events set start_event='$data_hora_i_c' ,end_event='$data_hora_f',notas='$notashospede'  where id=$id";
                
             //    echo $sql."<br>";
                $stmt = sqlsrv_query($conn, $sql);
                if ($stmt === false) {
                    die(print_r("Erro 4".sqlsrv_errors(), true));
                }
    
                $data['success'] = true;
                $data['message'] = 'Success!';
            
         }    
      
    } else {

        $data['success'] = false;
        $data['errors'] = $error;
    }

    echo json_encode($data);
}
?>