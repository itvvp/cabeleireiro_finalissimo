<?php
// Timer setter helper - centraliza emulação de "now" para scripts
// Mecanismos de configuração: $_REQUEST['time_emulator'], $_SESSION['time_emulator'], env TIME_EMULATOR
session_start();

function ts_get_time_emulator(): string {
    if (!empty($_REQUEST['time_emulator'])) return trim($_REQUEST['time_emulator']);
    if (!empty($_SESSION['time_emulator'])) return trim($_SESSION['time_emulator']);
    $env = getenv('TIME_EMULATOR');
    return $env !== false ? trim($env) : '';
}

function ts_force_year_only_from_emulator(string $em): bool {
    return preg_match('/^\d{4}$/', $em) === 1;
}

function ts_get_emulated_now(): DateTimeImmutable {
    $em = ts_get_time_emulator();
    if ($em === '') {
        return new DateTimeImmutable('now');
    }
    if (preg_match('/^\d{4}$/', $em)) {
        // Year-only emulator -> return start of that year
        return new DateTimeImmutable("{$em}-01-01");
    }
    // try parse full date/time
    return new DateTimeImmutable($em);
}

/**
 * Retorna expressão SQL para ponto inicial da deleção (ex.: GETDATE() ou 'YYYY-01-01 00:00:00')
 */
function ts_get_delete_start_expr(): string {
    $em = ts_get_time_emulator();
    $now = ts_get_emulated_now();
    if ($em === '') return 'GETDATE()';
    echo $now->format('Y-m-d H:i:s');
    if (preg_match('/^\d{4}$/', $em)) {
        return "'" . $em . "-01-01 00:00:00'";
    }
    // se for data completa, devolve a string SQL literal
    $d = (new DateTimeImmutable($em))->format('Y-m-d H:i:s');
    return "'" . $d . "'";
}

/**
 * Retorna o "ano de geração" default para scripts que criam eventos do ano seguinte
 * Ex.: se emuladoNow é 2026 e quer gerar folgas para 2027 -> +1 por omissão.
 */
function ts_get_generation_year(int $offsetNextYear = 1): int {
    $now = ts_get_emulated_now();
    return (int)$now->format('Y') + $offsetNextYear;
}
?>