<?php

namespace App\Services\Blog;

use App\Concerns\ItemImport;
use App\Imports\Blog\PostCategoryImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PostCategoryImportService
{
    use ItemImport;

    public function import(Request $request)
    {
        $this->deleteLogFile('postcategory');

        $this->validateFile($request);

        Excel::import(new PostCategoryImport, $request->file('file'));

        $this->reportError('postcategory');
    }
}
