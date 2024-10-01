<?php

namespace App\Services\Master;

use App\Concerns\ItemImport;
use App\Imports\Master\ProductImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductImportService
{
    use ItemImport;

    public function import(Request $request)
    {
        $this->deleteLogFile('product');

        $this->validateFile($request);

        Excel::import(new ProductImport, $request->file('file'));

        $this->reportError('product');
    }
}
