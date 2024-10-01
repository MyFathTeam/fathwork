<?php

namespace App\Support;

trait FormatCodeNumber
{
    public function getCodeNumber(int $number = 0, int $digit = 0, string $format = '', string $date = ''): array
    {
        if (! $date) {
            $date = today()->toDateString();
        }

        $date = strtotime($date);

        $numberFormat = $format;

        $format = str_replace('%YEAR%', date('Y', $date), $format);
        $format = str_replace('%YEAR_SHORT%', date('y', $date), $format);
        $format = str_replace('%MONTH%', date('F', $date), $format);
        $format = str_replace('%MONTH_SHORT%', date('M', $date), $format);
        $format = str_replace('%MONTH_NUMBER%', date('m', $date), $format);
        $format = str_replace('%MONTH_NUMBER_SHORT%', date('n', $date), $format);
        $format = str_replace('%DAY%', date('d', $date), $format);
        $format = str_replace('%DAY_SHORT%', date('j', $date), $format);

        return [
            'code_number' => str_replace('%NUMBER%', str_pad($number, $digit, '0', STR_PAD_LEFT), $format),
            'number_format' => $numberFormat,
            'number' => $number,
        ];
    }
}
