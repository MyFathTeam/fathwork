<?php

namespace App\Services\Blog;

use App\Contracts\ListGenerator;
use App\Http\Resources\Blog\PostResource;
use App\Models\Blog\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class PostListService extends ListGenerator
{
    protected $allowedSorts = ['created_at', 'name'];

    protected $defaultSort = 'name';

    public function getHeaders(): array
    {
        $headers = [
            [
                'key' => 'name',
                'label' => trans('blog.post.props.name'),
                'sortable' => true,
                'visibility' => true,
            ],
            [
                'key' => 'postcategory',
                'label' => trans('blog.postcategory.postcategory'),
                'print_label' => 'categorytitle',
                'sortable' => false,
                'visibility' => true,
            ],
            [
                'key' => 'user',
                'label' => trans('user.user'),
                'print_label' => 'user.username',
                'sortable' => false,
                'visibility' => true,
            ],
            [
                'key' => 'description',
                'label' => trans('master.post.props.description'),
                'sortable' => false,
                'visibility' => false,
            ],
        ];

        if (request()->ajax()) {
            $headers[] = $this->actionHeader;
        }

        return $headers;
    }

    public function filter(Request $request): Builder
    {
        $search = $request->input('search');
        $query = Post::query()
            ->filter([
                'App\QueryFilters\LikeMatch:search,name,description',
            ]);
            if (!Auth::user()->hasRole(['admin'])) {
                $query->where('user_id', Auth::user()->id);
            }
            if (!empty($search)) {
                $query->orWhereHas('user', function ($userQuery) use ($search) {
                    $userQuery->where('name', 'LIKE', '%' . $search . '%');
                });
            }
        
            return $query;
    }

    public function paginate(Request $request): AnonymousResourceCollection
    {
        $sort = $this->getSort($this->allowedSorts, $this->defaultSort);
        $order = $this->getOrder($this->defaultOrder);
        $perPage = $this->getPageLength();
        $currentPage = $this->getCurrentPage();

        return PostResource::collection($this->filter($request)
                ->orderBy($sort, $order)
                ->paginate((int) $perPage, ['*'], 'current_page'))
        ->additional([
            'headers' => $this->getHeaders(),
            'meta' => [
                'allowed_sorts' => $this->allowedSorts,
                'default_sort' => $this->defaultSort,
                'default_order' => $this->defaultOrder,
            ],
        ]);
    }

    public function list(Request $request): AnonymousResourceCollection
    {
        return $this->paginate($request);
    }
}
