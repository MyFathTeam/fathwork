<?php

namespace App\Concerns;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait HasCodeNumber
{
    public static function bootHasCodeNumber()
    {
    }

    public function scopeCodeNumber(Builder $query, string $numberFormat, string $date, string $field = 'date'): int
    {
        if (Str::of($numberFormat)->contains(['%DAY%', '%DAY_SHORT%'])) {
            $codeNumber = $query->whereNumberFormat($numberFormat)->where($field, $date)->count() + 1;
        } elseif (Str::of($numberFormat)->contains(['%MONTH%', '%MONTH_NUMBER%', '%MONTH_NUMBER_SHORT%', '%MONTH_SHORT%'])) {
            $codeNumber = $query->whereNumberFormat($numberFormat)->whereMonth($field, Carbon::parse($date)->month)->whereYear($field, Carbon::parse($date)->year)->count() + 1;
        } elseif (Str::of($numberFormat)->contains(['%YEAR%', '%YEAR_SHORT%'])) {
            $codeNumber = $query->whereNumberFormat($numberFormat)->whereYear($field, Carbon::parse($date)->year)->count() + 1;
        } else {
            $codeNumber = $query->whereNumberFormat($numberFormat)->max('number') + 1;
        }

        return $codeNumber;
    }
}
