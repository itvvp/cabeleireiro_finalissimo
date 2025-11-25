<?php
include("../bd/conexao.php");
$data = [];

/*
$result = $db->rows("SELECT * FROM events ORDER BY id");
foreach($result as $row) {
    $data[] = [
        'id'              => $row->id,
        'title'           => $row->title,
        'start'           => $row->start_event,
        'end'             => $row->end_event,
        'backgroundColor' => $row->color,
        'textColor'       => $row->text_color
    ];
}

*/

$sql="SELECT * FROM events where cabeleireira='2' ORDER BY id";
$sqlFerias="SELECT * FROM ferias where cabeleireira_id='2' ORDER BY id";
$stmt = sqlsrv_query($conn, $sql);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}
$a=0;
while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
{
    $dados=$row["title"];
    if($row["nome_hospede"]!="")
        $dados=$dados." ; ".$row["nome_hospede"];
    if($row["quarto"]!="")
        $dados=$dados." ; ".$row["quarto"];
    if($row["notas"]!="")
        $dados=$dados." ; ".$row["notas"];
      
    $data[] = [
        'id'              => $row["id"],
        'title'           => $dados,
        'start'           => $row["start_event"]->format("Y-m-d H:i:s"),
        'end'             => $row["end_event"]->format("Y-m-d H:i:s"),
        'backgroundColor' => $row["color"],
        'textColor'       => $row["text_color"]
    ];
    $a++;
}

// <-- ADICIONADO: carregar também as férias
$stmtF = sqlsrv_query($conn, $sqlFerias);
if ($stmtF === false) {
    die(print_r(sqlsrv_errors(), true));
}
while ($f = sqlsrv_fetch_array($stmtF, SQLSRV_FETCH_ASSOC)) {
    $startRaw = $f['start_ferias'];
    $endRaw   = $f['end_ferias'];

    // normaliza para strings YYYY-MM-DD HH:MM:SS
    if (is_object($startRaw) && method_exists($startRaw, 'format')) {
        $start = $startRaw->format('Y-m-d') . ' 15:00:00';
    } else {
        $start = substr((string)$startRaw, 0, 10) . ' 15:00:00';
    }
    if (is_object($endRaw) && method_exists($endRaw, 'format')) {
        $end = $endRaw->format('Y-m-d') . ' 21:00:00';
    } else {
        $end = substr((string)$endRaw, 0, 10) . ' 21:00:00';
    }

    $title = isset($f['nome']) ? 'Férias - ' . $f['nome'] : 'Férias';

    $data[] = [
        'id' => 'ferias-' . $f['id'],
        'title' => $title,
        'start' => $start,
        'end' => $end,
        'backgroundColor' => '#cc00ffff',
        'textColor' => '#ffffff'
    ];
}

echo json_encode($data);
?>