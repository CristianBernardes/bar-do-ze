<?php

namespace App\Helpers;

use NumberFormatter;

class NumericFormatting
{
    /**
     * @param $value
     * @return string
     */
    public static function formatBraziliancurrency($value): string
    {
        $formatter = new NumberFormatter('pt_BR',  NumberFormatter::CURRENCY);

        return $formatter->formatCurrency($value, 'BRL');
    }
}
