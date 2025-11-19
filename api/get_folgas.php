<?php
session_start();
include("../bd/conexao.php");
header('Content-Type: application/json');

$ret = ['success'=>false,'data'=>[]];

// selecciona todos os terapeutas, mesmo sem folgas (LEFT JOIN)
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
    // normaliza o id do terapeuta
    $tid = isset($r['terapeuta_id']) ? intval($r['terapeuta_id']) : 0;
    if ($tid <= 0) continue; // ignora linhas fantasmas, se houver

    if (!isset($terapeutas[$tid])) $terapeutas[$tid] = ['id'=>$tid,'nome'=>$r['nome'],'dias'=>[]];

    // adiciona dia apenas quando existe (permite terapeutas sem dias)
    if ($r['dias_folga'] !== null && $r['dias_folga'] !== '') {
        $dia = intval($r['dias_folga']);
        if (!in_array($dia, $terapeutas[$tid]['dias'])) {
            $terapeutas[$tid]['dias'][] = $dia;
        }
    }
}

// após construir $terapeutas
// remover terapeutas sem dias
$terapeutas = array_filter($terapeutas, function($t){ return !empty($t['dias']); });

$ret['success'] = true;
$ret['data'] = array_values($terapeutas);
echo json_encode($ret);
exit;
?>