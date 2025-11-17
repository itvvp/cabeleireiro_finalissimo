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

$sql="SELECT events.id, events.title, events.start_event, events.end_event, events.color, events.text_color, events.id_tratamento, events.nome_hospede, events.quarto, events.notas, events.cabeleireira, terapeutas.nome FROM events INNER JOIN terapeutas ON events.cabeleireira = terapeutas.id ORDER BY id";
//echo $sql."<br>";
$stmt = sqlsrv_query($conn, $sql);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}
$a=0;
while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
{
    if($row["nome"]!="")
        $dados=$row["nome"];
    $dados=$dados." ; ".$row["title"];
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
echo json_encode($data);
?>