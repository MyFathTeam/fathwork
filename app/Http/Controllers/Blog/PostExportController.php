<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Services\Blog\PostListService;
use Illuminate\Http\Request;

class PostExportController extends Controller
{
    public function __invoke(Request $request, PostListService $service)
    {
        $list = $service->list($request);

        return $service->export($list);
    }
}
