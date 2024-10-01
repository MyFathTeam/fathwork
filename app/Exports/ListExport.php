<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;

class ListExport implements FromArray
{
    protected $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function array(): array
    {
        return $this->items;
    }
}
