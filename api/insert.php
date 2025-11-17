<?php
session_start();
/**use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
*/
error_reporting(E_ALL);

include("../bd/conexao.php");


function envia_email(){
   

/*

//Load Composer's autoloader
//require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
  //  $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
  $mail->SMTPDebug = 0;
  //$mail -> charSet = "UTF-8"; 
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = '192.168.20.250';                     //Set the SMTP server to send through
  //  $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
  //  $mail->Username   = 'user@example.com';                     //SMTP username
  //  $mail->Password   = 'secret';                               //SMTP password
  //  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
 //   $mail->Port       = 25;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('aplicacoes@vilavitaparc.com');
    $mail->addAddress('cserranheira@vilavitaparc.com');     //Add a recipient
   // $mail->addAddress('ellen@example.com');               //Name is optional
  //  $mail->addReplyTo('info@example.com', 'Information');
  //  $mail->addCC('cc@example.com');
  //  $mail->addBCC('bcc@example.com');

    //Attachments
 //   $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
  //  $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
	
	$mail->CharSet = 'UTF-8';
$mail->Encoding = 'quoted-printable';
$someSubjectWithTildes = 'Subscripción España';
$mail->Subject = html_entity_decode($someSubjectWithTildes);	
 //   $mail->Subject = 'Existem novas marcaçoes';
    $mail->Body    = 'Existe uma nova marcaçºao <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}*/
}

if (isset($_REQUEST['NomeHospede'])) {

    
    //collect data
    $error      = null;
    $id_tratamento=$_REQUEST["tratamento"];
    $NomeHospede=$_REQUEST["NomeHospede"];
    $QuartoHospede=$_REQUEST["QuartoHospede"];
    $NotasHospede=$_REQUEST["NotasHospede"];
   
    $NomeHospede=str_replace("'","",$NomeHospede);
    $QuartoHospede=str_replace("'","",$QuartoHospede);
    $NotasHospede=str_replace("'","",$NotasHospede);
 //   $title      = $_POST['title'];
    $start      = $_REQUEST['startDate'];
    $startTime        = $_REQUEST['startTime'];
    $enddate_inserir=$_REQUEST["enddate_inserir"];
    
  //  $color      = $_POST['color'];
//    $text_color = $_POST['text_color'];


    //validation
   if ($id_tratamento == '') {
        $error['tratamento'] = 'A seleção do tratamento é obrigatória';
    }
    if ($NomeHospede == '') {
        $error['NomeHospede'] = 'A seleção do Nome do Hospede é obrigatória';
    }

    if ($start == '') {
        $error['start'] = 'Insira a data para o inicio do tratamento';
    }

    if ($startTime == '') {
        $error['startTime'] = 'A hora de ínicio do tratamento é obrigatória';
    }



   
    //if there are no errors, carry on
    if (! isset($error)) {
        if( $enddate_inserir=="")
        {

            $sql="select * from tratamentos where id=$id_tratamento";
        // echo $sql."<br>";
            $stmt = sqlsrv_query($conn, $sql);
            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
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

        
            $title = $designacao;

        // $data_hora_i=date('Y-m-d', strtotime($start))." ".date('H:i:s', strtotime($startTime));

            $data_hora_i=$start." ".$startTime;
            $data_hora_i_c= $data_hora_i;
        // $data_hora_i=date('d/m/Y H:i:s', $data_hora_i);
            //echo $data_hora_i."<br>";
        // $data_hora_i=date('Y-m-d H:i:s', strtotime($data_hora_i));
        /* $temp=explode("/",$start);
        $dia=$temp[0];
        $mes=$temp[1];
        $ano=$temp[2];
        $data_hora_i_c=$ano."-".$mes."-".$dia." ".$startTime;
    */
        
        //  echo $data_hora_i_c."<br>";

            $d2 = "+ $duracao_h hours"; // Tempo esperado para finalizar o atendimento
            $d3 = "+ $duracao_m minutes"; 

        //   echo $d2."<br>";
        //   echo $d3."<br>";

            $data_hora_f = strtotime($data_hora_i_c . $d2 .$d3);
            $data_hora_f=date('Y-m-d H:i:s', $data_hora_f);

            //format date
        // $start = date('Y-m-d H:i:s', strtotime($data_hora_i));
        //   $end = date('Y-m-d H:i:s', strtotime($data_hora_i));
            
            $sql="select count(*) as total from events where (('$data_hora_i_c'>=start_event and '$data_hora_i_c'<end_event) or 
            ('$data_hora_f'>start_event and '$data_hora_f'<=end_event)) and id_tratamento!=9999 and cabeleireira='1'";
           // echo $sql."<br>";
            $stmt = sqlsrv_query($conn, $sql);
            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            $numero_registos=$row["total"];

            $perfil=$_SESSION["perfil"];
//echo $perfil."<br>";
            if($perfil!=2)
            {
                $sql="select count(*) as total from events where (('$data_hora_i_c'>=start_event and '$data_hora_i_c'<end_event) or 
                ('$data_hora_f'>start_event and '$data_hora_f'<=end_event)) and id_tratamento=9999 and cabeleireira='1'";
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
                    $sql="insert into events(title,start_event,end_event,color,text_color,id_tratamento,nome_hospede,quarto,notas,cabeleireira) values('$title','$data_hora_i_c','$data_hora_f','#6453e9','#ffffff',$id_tratamento,'$NomeHospede','$QuartoHospede','$NotasHospede','1')";
                    //echo $sql."<br>";
                    $stmt = sqlsrv_query($conn, $sql);
                    if ($stmt === false) {
                        die(print_r(sqlsrv_errors(), true));
                    }

               //    envia_email();

                    $data['success'] = true;
                    $data['message'] = 'Success!';
                }   
            }    
      
        }
        else
        {
            $start=date('Y/m/d',strtotime($start));
            $enddate_inserir=date('Y/m/d',strtotime($enddate_inserir));
            while($start<=$enddate_inserir)
            {
                $sql="select * from tratamentos where id=$id_tratamento";
            // echo $sql."<br>";
                $stmt = sqlsrv_query($conn, $sql);
                if ($stmt === false) {
                    die(print_r(sqlsrv_errors(), true));
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

            
                $title = $designacao;

            // $data_hora_i=date('Y-m-d', strtotime($start))." ".date('H:i:s', strtotime($startTime));

                $data_hora_i=$start." ".$startTime;
                $data_hora_i_c= $data_hora_i;
            // $data_hora_i=date('d/m/Y H:i:s', $data_hora_i);
                //echo $data_hora_i."<br>";
            // $data_hora_i=date('Y-m-d H:i:s', strtotime($data_hora_i));
            /* $temp=explode("/",$start);
            $dia=$temp[0];
            $mes=$temp[1];
            $ano=$temp[2];
            $data_hora_i_c=$ano."-".$mes."-".$dia." ".$startTime;
        */
            
            //  echo $data_hora_i_c."<br>";

                $d2 = "+ $duracao_h hours"; // Tempo esperado para finalizar o atendimento
                $d3 = "+ $duracao_m minutes"; 

            //   echo $d2."<br>";
            //   echo $d3."<br>";

                $data_hora_f = strtotime($data_hora_i_c . $d2 .$d3);
                $data_hora_f=date('Y-m-d H:i:s', $data_hora_f);

                //format date
            // $start = date('Y-m-d H:i:s', strtotime($data_hora_i));
            //   $end = date('Y-m-d H:i:s', strtotime($data_hora_i));
                
                $sql="select count(*) as total from events where (('$data_hora_i_c'>=start_event and '$data_hora_i_c'<end_event) or 
                ('$data_hora_f'>start_event and '$data_hora_f'<=end_event)) and id_tratamento!=9999 and cabeleireira='1'";
                $stmt = sqlsrv_query($conn, $sql);
                if ($stmt === false) {
                    die(print_r(sqlsrv_errors(), true));
                }
                $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
                $numero_registos=$row["total"];

                $perfil=$_SESSION["perfil"];

                if($perfil!=2)
                {
                    $sql="select count(*) as total from events where (('$data_hora_i_c'>=start_event and '$data_hora_i_c'<end_event) or 
                    ('$data_hora_f'>start_event and '$data_hora_f'<=end_event)) and id_tratamento=9999 and cabeleireira='1'";
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
                        $sql="insert into events(title,start_event,end_event,color,text_color,id_tratamento,nome_hospede,quarto,notas,cabeleireira) values('$title','$data_hora_i_c','$data_hora_f','#6453e9','#ffffff',$id_tratamento,'$NomeHospede','$QuartoHospede','$NotasHospede','1')";
                        //echo $sql."<br>";
                        $stmt = sqlsrv_query($conn, $sql);
                        if ($stmt === false) {
                            die(print_r(sqlsrv_errors(), true));
                        }

                        $data['success'] = true;
                        $data['message'] = 'Success!';

                        //envia email para o cabeleireiro
                     /*   
                        require 'PHPMailer/src/Exception.php';
                        require 'PHPMailer/src/PHPMailer.php';
                        require 'PHPMailer/src/SMTP.php';
                        $mail = new PHPMailer(true);
                        try {
                            //Enable verbose debug output
                            $mail->SMTPDebug = 2;
                            $mail->isSMTP();                                            //Send using SMTP
                            $mail->Host       = '192.168.20.250';                     //Set the SMTP server to send through
                            //Recipients
                            $mail->setFrom('aplicacoes@vilavitaparc.com');
                            $mail->addAddress('cserranheira@vilavitaparc.com');     //Add a recipient
                            //Content
                            $mail->isHTML(true);                                  //Set email format to HTML
                            $mail->CharSet = 'UTF-8';
                            $mail->Encoding = 'quoted-printable';
                            $someSubjectWithTildes = 'Existe uma nova marcação para '.$data_hora_i_c;
                            $mail->Subject = html_entity_decode($someSubjectWithTildes);
                            $corpo_email="Existe uma nova marcação com os seguintes dados:<br>Tratamento: ".$title."<br>Nome Hóspede: ".$NomeHospede."<br>Quarto: ".$QuartoHospede."<br>Data/Hora de Início do tratamento: ".$data_hora_i_c."<br>Data/Hora de Fim do tratamento: ".$data_hora_f."<br>Notas: ".$NotasHospede."<br>";

                            $mail->Body    = html_entity_decode($corpo_email);
                            $rodape="Este email foi enviado automáticamente pelo sistema. Não responda a este email.";
                            $mail->AltBody = html_entity_decode($rodape);
                        
                            $mail->send();
                           // echo 'Message has been sent';
                        } catch (Exception $e) {
                            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                        }*/

                    }   
                } 
                $start=date('Y/m/d', strtotime("+1 days",strtotime($start))); 
            }  
        }
    } else {

        $data['success'] = false;
        $data['errors'] = $error;
    }

    echo json_encode($data);
}
?>