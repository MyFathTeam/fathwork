<?php

namespace App\ValueObjects;

use Illuminate\Support\Arr;

class Currency
{
    public readonly string $value;

    public readonly string $name;

    public readonly string $symbol;

    public readonly string $position;

    public readonly string $decimal;

    public readonly string $thousand;

    public readonly string $decimalDelimeter;

    public readonly string $thousandDelimeter;

    public function __construct(mixed $value = null)
    {
        if (! is_string($value)) {
            $value = null;
        }

        $this->value = $value ?? config('config.system.currency');

        $detail = $this->getCurrencyDetail();

        $this->name = Arr::get($detail, 'name');

        $this->symbol = Arr::get($detail, 'symbol');

        $this->position = Arr::get($detail, 'position');

        $this->decimal = Arr::get($detail, 'decimal');

        $this->decimalDelimeter = Arr::get($detail, 'decimal_delimeter');

        $this->thousandDelimeter = Arr::get($detail, 'thousand_delimeter');
    }

    public static function from(mixed $value): self
    {
        return new self($value);
    }

    public function getCurrencyDetail()
    {
        $currencies = collect(Arr::getVar('currencies'));

        return $currencies->firstWhere('name', $this->value) ?? [];
    }
}
