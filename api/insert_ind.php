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

            // Buscar eventos sobrepostos e devolver lista para o frontend mostrar
            $sql = "SELECT id, title, CONVERT(varchar, start_event, 120) AS start_event, CONVERT(varchar, end_event, 120) AS end_event,
                           notas, id_tratamento, nome_hospede, quarto
                    FROM events
                    WHERE NOT (end_event <= ? OR start_event >= ?)
                      AND cabeleireira = ?";
            $params = array($data_hora_i_c, $data_hora_f, $cabeleireira);
            $stmt = sqlsrv_query($conn, $sql, $params);
            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }
            $overlaps = array();
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $overlaps[] = $row;
            }
            $numero_registos = count($overlaps);
 
             if ($numero_registos > 0) {
                 $error['totalRegistos'] = 'O horário que definiu para o tratamento já se encontra ocupado';
                 $data['success'] = false;
                 $data['errors'] = $error;
                // anexar lista de marcações activas que causam o conflito
                $data['overlaps'] = $overlaps;
             } 
             else{
                 
                 // parâmetro para INSERT para evitar problemas se houver aspas e para segurança
                $insertSql = "INSERT INTO events (title,start_event,end_event,color,text_color,id_tratamento,notas,cabeleireira) VALUES (?,?,?,?,?,?,?,?)";
                $insertParams = array($title, $data_hora_i_c, $data_hora_f, $cor, '#ffffff', 9999, $NotasHospede, $cabeleireira);
                $stmt = sqlsrv_query($conn, $insertSql, $insertParams);
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

            // Primeiro passo: verificar todos os dias do intervalo para possíveis sobreposições
            $current = $startdate_inserir;
            $all_overlaps = array();
            while($current <= $enddate_inserir)
            {
                $data_hora_i_c = $current." ".$starttime_inserir;
                $data_hora_f = $current." ".$endtime_inserir;

                $sql = "SELECT id, title, CONVERT(varchar, start_event, 120) AS start_event, CONVERT(varchar, end_event, 120) AS end_event,
                               notas, id_tratamento, nome_hospede, quarto
                        FROM events
                        WHERE NOT (end_event <= ? OR start_event >= ?)
                          AND id_tratamento != 9999
                          AND title != ?
                          AND cabeleireira = ?";
                $params = array($data_hora_i_c, $data_hora_f, 'Serviço Indisponivel', $cabeleireira);
                $stmt = sqlsrv_query($conn, $sql, $params);
                if ($stmt === false) {
                    die(print_r(sqlsrv_errors(), true));
                }

                $overlaps = array();
                while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                    $overlaps[] = $row;
                }

                if (count($overlaps) > 0) {
                    $all_overlaps = array_merge($all_overlaps, $overlaps);
                    break; // já encontrou conflito, não continuar verificando
                }

                $current = date('Y/m/d', strtotime("+1 days", strtotime($current)));
            }

            if (count($all_overlaps) > 0) {
                $error['totalRegistos'] = 'Existem eventos marcados no intervalo fornecido';
                $data['success'] = false;
                $data['errors'] = $error;
                $data['overlaps'] = $all_overlaps;
            } else {
                // Sem sobreposições: inserir cada dia do intervalo
                $current = $startdate_inserir;
                while($current <= $enddate_inserir)
                {
                    $title = "Horário não disponível";
                    $data_hora_i_c = $current." ".$starttime_inserir;
                    $data_hora_f = $current." ".$endtime_inserir;

                    $insertSql = "INSERT INTO events (title,start_event,end_event,color,text_color,id_tratamento,notas,cabeleireira) VALUES (?,?,?,?,?,?,?,?)";
                    $insertParams = array($title, $data_hora_i_c, $data_hora_f, $cor, '#ffffff', 9999, $NotasHospede, $cabeleireira);
                    $stmt = sqlsrv_query($conn, $insertSql, $insertParams);
                    if ($stmt === false) {
                        die(print_r(sqlsrv_errors(), true));
                    }

                    $current = date('Y/m/d', strtotime("+1 days", strtotime($current)));
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

?>