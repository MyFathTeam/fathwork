<?php

namespace App\Imports\Master;

use App\Concerns\ItemImport;
use App\Models\Master\ProductCategory;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductCategoryImport implements ToCollection, WithHeadingRow
{
    use ItemImport;

    protected $limit = 10;

    public function collection(Collection $rows)
    {
        if (count($rows) > $this->limit) {
            throw ValidationException::withMessages(['message' => trans('general.errors.max_import_limit_crossed', ['attribute' => $this->limit])]);
        }

        $logFile = $this->getLogFile('productcategory');

        $errors = $this->validate($rows);

        $this->checkForErrors('productcategory', $errors);

        if (! request()->boolean('validate') && ! \Storage::exists($logFile)) {
            $this->import($rows);
        }
    }

    private function import(Collection $rows)
    {
        activity()->disableLogging();

        foreach ($rows as $row) {
            $productcategory = ProductCategory::forceCreate([
                'title' => Arr::get($row, 'title'),
            ]);
        }

        activity()->enableLogging();
    }

    private function validate(Collection $rows)
    {
        $errors = [];
        foreach ($rows as $index => $row) {
            $rowNo = $index + 2;

            $title = Arr::get($row, 'title');
            $description = Arr::get($row, 'description');

            if (! $title) {
                $errors[] = $this->setError($rowNo, trans('master.productcategory.props.title'), 'required');
            } elseif (strlen($title) < 2 || strlen($title) > 500) {
                $errors[] = $this->setError($rowNo, trans('master.productcategory.props.title'), 'min_max', ['min' => 2, 'max' => 500]);
            }
        }

        return $errors;
    }
}
