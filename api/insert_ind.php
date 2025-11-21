<?php
include("../bd/conexao.php");



    
    //collect data
    $error      = null;
    $startdate_inserir=$_REQUEST["startdate_inserir"];
    $enddate_inserir=$_REQUEST["enddate_inserir"];
    $starttime_inserir=$_REQUEST["starttime_inserir"];
    $endtime_inserir=$_REQUEST["endtime_inserir"];
    $NotasHospede=$_REQUEST["NotasHospede"];
    $cabeleireira=$_REQUEST["cabeleireira"];

    $cor="";
    if($cabeleireira==1)
        $cor="#ff0000";
    else
        $cor="#8B0000";
 
    //if there are no errors, carry on
    if (! isset($error)) {
       
        if( $enddate_inserir=="")
        {
            $title = "Horário não disponível";

            $data_hora_i_c=$startdate_inserir." ".$starttime_inserir;
            $data_hora_f=$startdate_inserir." ".$endtime_inserir;

            // Parameterized overlap check and pass params to sqlsrv_query
            $sql = "SELECT COUNT(*) AS total
                    FROM events
                    WHERE NOT (end_event <= ? OR start_event >= ?)
                      AND id_tratamento != 9999
                      AND cabeleireira = ?";
            $params = array($data_hora_i_c, $data_hora_f, $cabeleireira);
            $stmt = sqlsrv_query($conn, $sql, $params);
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
                
                $sql="insert into events(title,start_event,end_event,color,text_color,id_tratamento,notas,cabeleireira) values('$title','$data_hora_i_c','$data_hora_f','$cor','#ffffff',9999,'$NotasHospede','$cabeleireira')";
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
                $title = "Horário não disponível";
                $data_hora_i_c=$startdate_inserir." ".$starttime_inserir;
                $data_hora_f=$startdate_inserir." ".$endtime_inserir;

                // Use same parameterized overlap check inside the loop
                $sql = "SELECT COUNT(*) AS total
                        FROM events
                        WHERE NOT (end_event <= ? OR start_event >= ?)
                          AND id_tratamento != 9999
                          AND cabeleireira = ?";
                $params = array($data_hora_i_c, $data_hora_f, $cabeleireira);
                $stmt = sqlsrv_query($conn, $sql, $params);
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
                    
                    $sql="insert into events(title,start_event,end_event,color,text_color,id_tratamento,notas,cabeleireira) values('$title','$data_hora_i_c','$data_hora_f','$cor','#ffffff',9999,'$NotasHospede','$cabeleireira')";
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