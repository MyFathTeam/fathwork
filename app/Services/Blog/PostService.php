<?php

namespace App\Services\Blog;

use App\Models\Blog\Post;
use App\Models\Blog\PostCategory;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostService
{
    public function preRequisite(): array
    {
        $list = PostCategory::get();
        $postcategory = [];
        foreach ($list as $item => $value) {
            $postcategory[] = ['value' => $value->id, 'label' => $value->title];
        }
        return compact('postcategory');
    }

    public function create(Request $request): Post
    {
        $post = Post::forceCreate($this->formatParams($request));

        $post->addMedia($request);

        return $post;
    }

    private function formatParams(Request $request, ?Post $post = null): array
    {
        $formatted = [
            'name' => $request->name,
            'slug' => strtolower(str_replace(' ', '-', $request->name)),
            'post_category_id' => $request->postcategory,
            'description' => $request->description,
        ];

        if (!$post) {
            $formatted['user_id'] = Auth::id();
        }

        return $formatted;
    }

    public function update(Request $request, Post $post): void
    {
        $post->forceFill($this->formatParams($request, $post))->save();

        $post->updateMedia($request);
    }

    public function deletable(Post $post,  $validate = false): bool
    {
        if ($post->user_id != Auth::id()) {
            if ($validate) {
                return false;
            }

            throw ValidationException::withMessages(['message' => trans('user.errors.permission_denied')]);
        }

        return true;
    }
}
