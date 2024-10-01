<?php

namespace App\Services;

use App\Concerns\ItemImport;
use App\Imports\FaththinkImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class FaththinkImportService
{
    use ItemImport;

    public function import(Request $request)
    {
        $this->deleteLogFile('faththink');

        $this->validateFile($request);

        Excel::import(new FaththinkImport, $request->file('file'));

        $this->reportError('faththink');
    }
}
