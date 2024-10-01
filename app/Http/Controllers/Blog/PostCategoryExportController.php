<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Services\Blog\PostCategoryListService;
use Illuminate\Http\Request;

class PostCategoryExportController extends Controller
{
    public function __invoke(Request $request, PostCategoryListService $service)
    {
        $list = $service->list($request);

        return $service->export($list);
    }
}
