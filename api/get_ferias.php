<?php
session_start();
include __DIR__ . "/../bd/conexao.php";
header('Content-Type: application/json; charset=utf-8');

$sql = "SELECT 
    f.id,
    f.cabeleireira_id,
    f.start_ferias,
    f.end_ferias,
    f.created_at,
    c.nome
FROM [cabeleireiro].[dbo].[ferias] AS f
LEFT JOIN [cabeleireiro].[dbo].[terapeutas] AS c
    ON f.cabeleireira_id = c.id;
";
$stmt = sqlsrv_query($conn, $sql);
if ($stmt === false) {
    echo json_encode(['success' => false, 'error' => sqlsrv_errors()]);
    exit;
}

$list = [];
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $start = $row['start_ferias'];
    $end = $row['end_ferias'];
    $created = $row['created_at'];

    // retornar apenas a parte date (YYYY-MM-DD)
    if (is_object($start) && method_exists($start, 'format')) {
        $start = $start->format('Y-m-d');
    } elseif (is_string($start)) {
        $start = substr($start, 0, 10);
    }

    if (is_object($end) && method_exists($end, 'format')) {
        $end = $end->format('Y-m-d');
    } elseif (is_string($end)) {
        $end = substr($end, 0, 10);
    }

    if (is_object($created) && method_exists($created, 'format')) {
        $created = $created->format('Y-m-d');
    } elseif (is_string($created)) {
        $created = substr($created, 0, 10);
    }

    $list[] = [
        'id' => intval($row['id']),
        'cabeleireira_id' => intval($row['cabeleireira_id']),
        'nome' => $row['nome'],
        'start_ferias' => $start,
        'end_ferias' => $end,
        'created_at' => $created
    ];
}

echo json_encode(['success' => true, 'data' => $list]);
exit;
?>