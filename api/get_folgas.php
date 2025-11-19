<?php
session_start();
include("../bd/conexao.php");
header('Content-Type: application/json');

$ret = ['success'=>false,'data'=>[]];

// seleciona o id do terapeuta, nome e o valor armazenado em dias_folga (weekday)
$sql = "SELECT t.id AS terapeuta_id, t.nome, f.dias_folga
        FROM terapeutas t
        LEFT JOIN folgas f ON f.terapeutas_id = t.id
        ORDER BY t.nome, f.dias_folga";
$stmt = sqlsrv_query($conn, $sql);

if ($stmt === false) {
    $err = sqlsrv_errors();
    echo json_encode(['success'=>false,'error'=> $err ? json_encode($err) : 'Query error']);
    exit;
}

$terapeutas = [];
while ($r = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $tid = $r['terapeuta_id'];
    if (!isset($terapeutas[$tid])) $terapeutas[$tid] = ['id'=>$tid,'nome'=>$r['nome'],'dias'=>[]];
    if ($r['dias_folga'] !== null) {
        // Adicionar apenas se não for duplicado
        $dia = intval($r['dias_folga']);
        if (!in_array($dia, $terapeutas[$tid]['dias'])) {
            $terapeutas[$tid]['dias'][] = $dia;
        }
    }
}

$ret['success'] = true;
$ret['data'] = array_values($terapeutas);
echo json_encode($ret);
exit;
?>