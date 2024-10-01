<?php

namespace App\Services\Blog;

use App\Models\Blog\PostCategory;
use Illuminate\Http\Request;

class PostCategoryService
{
    public function create(Request $request): PostCategory
    {
        $postcategory = PostCategory::forceCreate($this->formatParams($request));

        return $postcategory;
    }

    private function formatParams(Request $request, ?PostCategory $postcategory = null): array
    {
        return [
            'title' => $request->title,
            'slug' => strtolower(str_replace(' ','-',$request->title)),
        ];
    }

    public function update(Request $request, PostCategory $postcategory): void
    {
        $postcategory->forceFill($this->formatParams($request, $postcategory))->save();

    }

    public function deletable(PostCategory $postcategory): void
    {
    }
}
