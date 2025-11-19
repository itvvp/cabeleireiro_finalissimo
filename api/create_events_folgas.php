<?php
include("../bd/conexao.php");
header('Content-Type: application/json');

$terapeuta_id = isset($_POST['terapeuta_id']) ? intval($_POST['terapeuta_id']) : 0;
$dias = isset($_POST['dias']) ? $_POST['dias'] : [];

if ($terapeuta_id <= 0 || empty($dias)) {
    echo json_encode(['success' => false, 'error' => 'terapeuta_id or dias missing/invalid']);
    exit;
}

// Map weekdays: 1=Monday (PHP 1), ..., 7=Sunday (PHP 0)
$weekday_map = [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 0];

$inserted = 0;
foreach ($dias as $dia) {
    $dia = intval($dia);
    if (!isset($weekday_map[$dia])) continue;
    $php_weekday = $weekday_map[$dia];

    // Loop through 2027
    $start_date = strtotime('2027-01-01');
    $end_date = strtotime('2027-12-31');
    for ($date = $start_date; $date <= $end_date; $date += 86400) {
        if (date('w', $date) == $php_weekday) {
            $date_str = date('Y-m-d', $date);
            $start_event = $date_str . ' 10:00:00';
            $end_event = $date_str . ' 19:00:00';
            $title = 'Folga';
            $color = '#00ccffff';
            $text_color = '#ffffff';
            $id_tratamento = 9999;

            $sql = "INSERT INTO events (title, start_event, end_event, color, text_color, id_tratamento, cabeleireira) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $params = [$title, $start_event, $end_event, $color, $text_color, $id_tratamento, $terapeuta_id];
            $stmt = sqlsrv_query($conn, $sql, $params);
            if ($stmt !== false) {
                $inserted++;
            }
        }
    }
}

echo json_encode(['success' => true, 'inserted' => $inserted]);
?>