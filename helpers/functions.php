<?php

/**
 * @param $monthNumber
 * @return string|void
 */
function monthFullName($monthNumber)
{
    $year = date('Y');

    switch ($monthNumber) {
        case 12:
            return "Dezembro de $year";

        case 11:
            return "Novembro de $year";

        case 10:
            return "Outubro de $year";

        case 9:
            return "Setembro de $year";

        case 8:
            return "Agosto de $year";

        case 7:
            return "Julho de $year";

        case 6:
            return "Junho de $year";

        case 5:
            return "Maio de $year";

        case 4:
            return "Abril de $year";

        case 3:
            return "Março de $year";

        case 2:
            return "Fevereiro de $year";

        case 1:
            return "Janeiro de $year";
    }
}

/**
 * @param $date
 * @param $format
 * @return string
 */
function formatDateAndTime($date, $format = 'd/m/Y')
{
    return \Carbon\Carbon::parse($date)->format($format);
}

/**
 * Obtém todos os dias de um determinado mês
 *
 * @param int|null $month
 * @param int|null $year
 * @return array
 */
function daysOfTheMonth(int $month = null, int $year = null): array
{
    // Obtém a data atual
    $date = \Carbon\Carbon::now();

    // Se não for passado um mês, usa o mês atual
    $month = $month ?? $date->month;

    // Se não for passado um ano, usa o ano atual
    $year = $year ??  $date->year;

    // Mapeia os dias do mês para formatar a data como Y-m-d
    return \Illuminate\Support\Arr::map(range(1, \Carbon\Carbon::createFromDate($year, $month, 1)->daysInMonth), function ($day) use ($year, $month) {

        return \Carbon\Carbon::createFromDate($year, $month, $day)->format('Y-m-d');
    });
}
