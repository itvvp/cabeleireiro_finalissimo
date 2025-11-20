<?php
include("../bd/conexao.php");
header('Content-Type: application/json');

include_once __DIR__ . '/../timerSetter.php';

$terapeuta_id = isset($_POST['terapeuta_id']) ? intval($_POST['terapeuta_id']) : 0;
$dias = isset($_POST['dias']) ? $_POST['dias'] : [];

$emulatedNow = ts_get_emulated_now();
// permitir override via POST 'ano', senão gerar para o ano baseado no timerSetter (por defeito next year)
$ano = isset($_POST['ano']) ? intval($_POST['ano']) : ts_get_generation_year(1);

// Map API weekday (1=Domingo,2=Segunda,...) -> PHP date('w') (0=Domingo,1=Segunda,...)
$weekday_map = [
    1 => 0, 
    2 => 1,
    3 => 2,
    4 => 3,
    5 => 4,
    6 => 5,
    7 => 6
];

$inserted = 0;
// Loop through $ano (em vez de hardcoded 2027)
foreach ($dias as $dia) {
    $dia = intval($dia);
    if (!isset($weekday_map[$dia])) continue;
    $php_weekday = $weekday_map[$dia];

    // Loop through 2027
    for ($date = strtotime("$ano-01-01"); $date <= strtotime("$ano-12-31"); $date += 86400) {
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