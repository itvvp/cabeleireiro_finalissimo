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

$sql="SELECT * FROM events where id_tratamento='9999' and cabeleireira='1' ORDER BY id";
$stmt = sqlsrv_query($conn, $sql);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}
$a=0;
while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC))
{
    $dados=$row["title"];
  
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