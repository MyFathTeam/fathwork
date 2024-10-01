<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Blog\PostRequest;
use App\Http\Resources\Blog\PostResource;
use App\Models\Blog\Post;
use App\Services\Blog\PostListService;
use App\Services\Blog\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function preRequisite(Request $request, PostService $service)
    {
        return response()->ok($service->preRequisite($request));
    }

    public function index(Request $request, PostListService $service)
    {
        return $service->paginate($request);
    }

    public function store(PostRequest $request, PostService $service)
    {
        $post = $service->create($request);

        return response()->success([
            'message' => trans('global.created', ['attribute' => trans('blog.post.post')]),
            'post' => PostResource::make($post),
        ]);
    }

    public function show(Post $post): PostResource
    {
        $post->load('media');

        return PostResource::make($post);
    }

    public function update(PostRequest $request, Post $post, PostService $service)
    {
        $service->update($request, $post);

        return response()->success([
            'message' => trans('global.updated', ['attribute' => trans('blog.post.post')]),
        ]);
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return response()->success([
            'message' => trans('global.deleted', ['attribute' => trans('blog.post.post')]),
        ]);
    }

    public function download(Post $post, $uuid)
    {
        return $post->downloadMedia($uuid);
    }
}
