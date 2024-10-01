<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Blog\PostCategoryRequest;
use App\Http\Resources\Blog\PostCategoryResource;
use App\Models\Blog\PostCategory;
use App\Services\Blog\PostCategoryListService;
use App\Services\Blog\PostCategoryService;
use Illuminate\Http\Request;

class PostCategoryController extends Controller
{
    public function index(Request $request, PostCategoryListService $service)
    {
        return $service->paginate($request);
    }

    public function store(PostCategoryRequest $request, PostCategoryService $service)
    {
        $postcategory = $service->create($request);

        return response()->success([
            'message' => trans('global.created', ['attribute' => trans('blog.postcategory.postcategory')]),
            'postcategory' => PostCategoryResource::make($postcategory),
        ]);
    }

    public function show(PostCategory $postcategory): PostCategoryResource
    {
        return PostCategoryResource::make($postcategory);
    }

    public function update(PostCategoryRequest $request, PostCategory $postcategory, PostCategoryService $service)
    {
        $service->update($request, $postcategory);

        return response()->success([
            'message' => trans('global.updated', ['attribute' => trans('blog.postcategory.postcategory')]),
        ]);
    }

    public function destroy(PostCategory $postcategory)
    {
        $postcategory->delete();

        return response()->success([
            'message' => trans('global.deleted', ['attribute' => trans('blog.postcategory.postcategory')]),
        ]);
    }

    public function download(PostCategory $postcategory, $uuid)
    {
        return $postcategory->downloadMedia($uuid);
    }
}
