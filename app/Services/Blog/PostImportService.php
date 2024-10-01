<?php

namespace App\Services\Blog;

use App\Concerns\ItemImport;
use App\Imports\Blog\PostImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PostImportService
{
    use ItemImport;

    public function import(Request $request)
    {
        $this->deleteLogFile('post');

        $this->validateFile($request);

        Excel::import(new PostImport, $request->file('file'));

        $this->reportError('post');
    }
}
