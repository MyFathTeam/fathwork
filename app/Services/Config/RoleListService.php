<?php

namespace App\Services\Config;

use App\Contracts\ListGenerator;
use App\Http\Resources\Config\RoleResource;
use App\Models\Config\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RoleListService extends ListGenerator
{
    protected $allowedSorts = ['created_at', 'name'];

    protected $defaultSort = 'name';

    protected $defaultOrder = 'asc';

    public function getHeaders(): array
    {
        $headers = [
            [
                'key' => 'name',
                'label' => trans('config.role.props.name'),
                'print_label' => 'label',
                'sortable' => true,
                'visibility' => true,
            ],
            [
                'key' => 'isDefault',
                'label' => '',
                'sortable' => false,
                'visibility' => true,
            ],
        ];

        if (request()->ajax()) {
            $headers[] = $this->actionHeader;
        }

        return $headers;
    }

    public function filter(Request $request): Builder
    {
        return Role::query()
            ->whereNotIn('name', ['admin'])
            ->filter([
                'App\QueryFilters\LikeMatch:search,name',
            ]);
    }

    public function paginate(Request $request): AnonymousResourceCollection
    {
        return RoleResource::collection($this->filter($request)
                ->orderBy($this->getSort(), $this->getOrder())
                ->paginate((int) $this->getPageLength(), ['*'], 'current_page'))
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
