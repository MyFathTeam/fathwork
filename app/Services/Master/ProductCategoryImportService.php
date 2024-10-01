<?php

namespace App\Services\Master;

use App\Concerns\ItemImport;
use App\Imports\Master\ProductCategoryImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductCategoryImportService
{
    use ItemImport;

    public function import(Request $request)
    {
        $this->deleteLogFile('productcategory');

        $this->validateFile($request);

        Excel::import(new ProductCategoryImport, $request->file('file'));

        $this->reportError('productcategory');
    }
}
