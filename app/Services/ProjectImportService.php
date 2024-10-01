<?php

namespace App\Services;

use App\Concerns\ItemImport;
use App\Imports\ProjectImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProjectImportService
{
    use ItemImport;

    public function import(Request $request)
    {
        $this->deleteLogFile('project');

        $this->validateFile($request);

        Excel::import(new ProjectImport, $request->file('file'));

        $this->reportError('project');
    }
}
