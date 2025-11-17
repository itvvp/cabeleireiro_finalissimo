<?php
include("../bd/conexao.php");



    
    //collect data
    $error      = null;
    $startdate_inserir=$_REQUEST["startdate_inserir"];
    $enddate_inserir=$_REQUEST["enddate_inserir"];
    $starttime_inserir=$_REQUEST["starttime_inserir"];
    $endtime_inserir=$_REQUEST["endtime_inserir"];
    $NotasHospede=$_REQUEST["NotasHospede"];
 
    //if there are no errors, carry on
    if (! isset($error)) {
       
        if( $enddate_inserir=="")
        {
            $title = "Horário não disponível";

        // $data_hora_i=date('Y-m-d', strtotime($start))." ".date('H:i:s', strtotime($startTime));

            $data_hora_i_c=$startdate_inserir." ".$starttime_inserir;
            $data_hora_f=$startdate_inserir." ".$endtime_inserir;

        
            
            $sql="select count(*) as total from events where ('$data_hora_i_c'>=start_event and '$data_hora_i_c'<=end_event) or 
            ('$data_hora_f'>=start_event and '$data_hora_f'<=end_event) and id_tratamento!=9999 and cabeleireira='1'";
            $stmt = sqlsrv_query($conn, $sql);
            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            $numero_registos=$row["total"];

        
            if ($numero_registos>0) {
                $error['totalRegistos'] = 'O horário que definiu para o tratamento já se encontra ocupado';
                $data['success'] = false;
                $data['errors'] = $error;
            } 
            else{
                
                $sql="insert into events(title,start_event,end_event,color,text_color,id_tratamento,notas,cabeleireira) values('$title','$data_hora_i_c','$data_hora_f','#ff0000','#ffffff',9999,'$NotasHospede','1')";
                //echo $sql."<br>";
                $stmt = sqlsrv_query($conn, $sql);
                if ($stmt === false) {
                    die(print_r(sqlsrv_errors(), true));
                }

                $data['success'] = true;
                $data['message'] = 'Success!';
                
            }    
        }
        else
        {
            $startdate_inserir=date('Y/m/d',strtotime($startdate_inserir));
            $enddate_inserir=date('Y/m/d',strtotime($enddate_inserir));
            while($startdate_inserir<=$enddate_inserir)
            {
               // echo $startdate_inserir." & ".$enddate_inserir."<br>";
                $title = "Horário não disponível";

                // $data_hora_i=date('Y-m-d', strtotime($start))." ".date('H:i:s', strtotime($startTime));

                $data_hora_i_c=$startdate_inserir." ".$starttime_inserir;
                $data_hora_f=$startdate_inserir." ".$endtime_inserir;

            
                
                $sql="select count(*) as total from events where ('$data_hora_i_c'>=start_event and '$data_hora_i_c'<=end_event) or 
                ('$data_hora_f'>=start_event and '$data_hora_f'<=end_event) and id_tratamento!=9999 and cabeleireira='1'";
               // echo $sql."<br>";
                $stmt = sqlsrv_query($conn, $sql);
                if ($stmt === false) {
                    die(print_r(sqlsrv_errors(), true));
                }
                $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
                $numero_registos=$row["total"];

            
                if ($numero_registos>0) {
                    $error['totalRegistos'] = 'O horário que definiu para o tratamento já se encontra ocupado';
                    $data['success'] = false;
                    $data['errors'] = $error;
                } 
                else{
                    
                    $sql="insert into events(title,start_event,end_event,color,text_color,id_tratamento,notas,cabeleireira) values('$title','$data_hora_i_c','$data_hora_f','#ff0000','#ffffff',9999,'$NotasHospede','1')";
                    //echo $sql."<br>";
                    $stmt = sqlsrv_query($conn, $sql);
                    if ($stmt === false) {
                        die(print_r(sqlsrv_errors(), true));
                    }

                    $data['success'] = true;
                    $data['message'] = 'Success!';
                    
                }  
                $startdate_inserir=date('Y/m/d', strtotime("+1 days",strtotime($startdate_inserir))); 
            }  
        }  
      

      
    } else {

        $data['success'] = false;
        $data['errors'] = $error;
    }

    echo json_encode($data);

?>