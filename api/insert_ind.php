<?php
header('Content-Type: application/json; charset=utf-8');
session_start();
include __DIR__ . '/../bd/conexao.php'; // adapte se necessário

// Ler POST
$cabeleireira = isset($_POST['cabeleireira']) ? $_POST['cabeleireira'] : null;
$startdate = isset($_POST['startdate_inserir']) ? $_POST['startdate_inserir'] : null;
$enddate   = isset($_POST['enddate_inserir']) && $_POST['enddate_inserir'] !== '' ? $_POST['enddate_inserir'] : $startdate;
$starttime = isset($_POST['starttime_inserir']) ? $_POST['starttime_inserir'] : null;
$endtime   = isset($_POST['endtime_inserir']) ? $_POST['endtime_inserir'] : null;
$notas     = isset($_POST['NotasHospede']) ? $_POST['NotasHospede'] : '';

// validações básicas
if (!$cabeleireira || !$startdate || !$starttime || !$endtime) {
    echo json_encode(['success' => false, 'error' => 'Dados incompletos']);
    exit;
}

// construir datetimes no formato usado na BD (ajuste se necessário)
$start_dt = date('Y-m-d H:i:s', strtotime($startdate . ' ' . $starttime));
$end_dt   = date('Y-m-d H:i:s', strtotime($enddate . ' ' . $endtime));

// Verificar overlaps
// Condição de overlap: evento.start < novo_end AND evento.end > novo_start
// Filtrar por terapeuta igual e (id_tratamento = 9999 OR title <> 'Serviço não disponivel')
$sql = "
    SELECT id, title, nome_hospede, quarto, start_event, end_event, notas, id_tratamento
    FROM eventos
    WHERE id_terapeuta = ?
      AND (start_event < ? AND end_event > ?)
      AND (id_tratamento = 9999 OR ISNULL(title,'') <> 'Serviço não disponivel')
    ORDER BY start_event
";
$params = [$cabeleireira, $end_dt, $start_dt];
$stmt = sqlsrv_query($conn, $sql, $params);
if ($stmt === false) {
    $err = sqlsrv_errors();
    echo json_encode(['success' => false, 'error' => $err]);
    exit;
}

$overlaps = [];
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    // formatar datas com segurança (DateTime ou string)
    $start_event = '';
    $end_event = '';
    if (isset($row['start_event'])) {
        if ($row['start_event'] instanceof DateTime) {
            $start_event = $row['start_event']->format('Y-m-d H:i');
        } else {
            $start_event = (string)$row['start_event'];
        }
    }
    if (isset($row['end_event'])) {
        if ($row['end_event'] instanceof DateTime) {
            $end_event = $row['end_event']->format('Y-m-d H:i');
        } else {
            $end_event = (string)$row['end_event'];
        }
    }

    $overlaps[] = [
        'id' => $row['id'],
        'title' => $row['title'],
        'nome_hospede' => $row['nome_hospede'],
        'quarto' => $row['quarto'],
        'start_event' => $start_event,
        'end_event' => $end_event,
        'notas' => $row['notas'],
        'id_tratamento' => $row['id_tratamento']
    ];
}

if (count($overlaps) > 0) {
    echo json_encode(['success' => false, 'overlaps' => $overlaps]);
    exit;
}

// Sem overlaps: inserir bloqueio (id_tratamento = 9999, title = 'Serviço não disponivel')
$insertSql = "
    INSERT INTO eventos (id_terapeuta, title, start_event, end_event, notas, id_tratamento, criado_por, data_criacao)
    VALUES (?, ?, ?, ?, ?, ?, ?, GETDATE())
";
$title = 'Serviço não disponivel';
$id_trat = 9999;
$criado_por = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$insertParams = [$cabeleireira, $title, $start_dt, $end_dt, $notas, $id_trat, $criado_por];

$insStmt = sqlsrv_query($conn, $insertSql, $insertParams);
if ($insStmt === false) {
    $err = sqlsrv_errors();
    echo json_encode(['success' => false, 'error' => $err]);
    exit;
}

echo json_encode(['success' => true]);
exit;
?>