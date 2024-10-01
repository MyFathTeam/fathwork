<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Services\Blog\PostCategoryImportService;
use Illuminate\Http\Request;

class PostCategoryImportController extends Controller
{
    public function __invoke(Request $request, PostCategoryImportService $service)
    {
        $service->import($request);

        if (request()->boolean('validate')) {
            return response()->success([
                'message' => trans('general.data_validated'),
            ]);
        }

        return response()->success([
            'imported' => true,
            'message' => trans('global.imported', ['attribute' => trans('blog.postcategory.postcategory')]),
        ]);
    }
}
