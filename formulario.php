<?php
    session_start();

	include "bd/conexao.php";
	//include "sessao.php"; 
    date_default_timezone_set('Europe/Lisbon');
    error_reporting(E_ALL & ~E_NOTICE);
?>
<div class="row">

<div class="col-md-12">

    <form action="api/insert.php" method="post">
    <div id="title-group" class="form-group">
        <label class="control-label" for="title">Selecione o Tratamento</label>
        <select class="form-control" id="tratamento" name="tratamento" required autocomplete="off">
            <option>Selecione o tratamento</option>
            <?php
                $sql4="select * from tratamentos order by tratamento";
                $stmt4 = sqlsrv_query($conn, $sql4);
                if ($stmt4 === false) {
                    die(print_r(sqlsrv_errors(), true));
                }
                while ($row4 = sqlsrv_fetch_array($stmt4, SQLSRV_FETCH_ASSOC)) {
                    $id_tratamento=$row4["id"];

                    if (mb_detect_encoding($row4['tratamento'], 'UTF-8', true)==false) {
                        $designacao=iconv('ISO-8859-1', 'UTF-8', $row4["tratamento"]);
                    } elseif (mb_detect_encoding($row4['tratamento'])=='ASCII') {
                        $designacao=iconv('ISO-8859-1', 'UTF-8', $row4["tratamento"]);
                    } else {
                        $designacao= $row4["tratamento"];
                    } 
            ?>
                    <option value="<?php echo $id_tratamento;?>" ><?php echo $designacao;?></option>
            <?php   } ?>      
        </select>
        <!-- errors will go here -->
    </div>

    <div id="edit-title-group" class="form-group">
        <label class="control-label" for="NomeHospede">Insira o nome do(a) hóspede</label>
        <input type="text" class="form-control" id="NomeHospede" required name="NomeHospede" autocomplete="off">
        <!-- errors will go here -->
    </div>


    <div id="startdate-group" class="form-group">
        <label class="control-label" for="startDate">Data do tratamento</label>
        <input type="date" class="form-control" id="startDate" required name="startDate" autocomplete="off"> 
        <!-- errors will go here -->
    </div>

    <div id="startdate-group" class="form-group">
        <label class="control-label" for="startTime">Hora de inicio do tratamento</label>
        <input type="time" class="form-control" id="startTime" required name="startTime" autocomplete="off"> 
        <!-- errors will go here -->
    </div>
    <button type="submit">Gravar</button>

    </form>

</div>


</div>