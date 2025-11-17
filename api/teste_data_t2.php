<?php

$d1 = "2021-06-17 11:30"; // Data e hora que o atendimento começou
$d2 = "+ 00 hours"; // Tempo esperado para finalizar o atendimento
$d3 = "+ 30 minutes"; 

$teste = strtotime($d1 . $d2 .$d3);

echo date('d/m/Y H:i:s', $teste);
?>