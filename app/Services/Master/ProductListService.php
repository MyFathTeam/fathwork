<?php

namespace App\Services\Master;

use App\Contracts\ListGenerator;
use App\Http\Resources\Master\ProductResource;
use App\Models\Master\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductListService extends ListGenerator
{
    protected $allowedSorts = ['created_at', 'name'];

    protected $defaultSort = 'name';

    public function getHeaders(): array
    {
        $headers = [
            [
                'key' => 'name',
                'label' => trans('master.product.props.name'),
                'sortable' => true,
                'visibility' => true,
            ],
            [
                'key' => 'productcategory',
                'label' => trans('master.productcategory.productcategory'),
                'print_label' => 'categorytitle',
                'sortable' => false,
                'visibility' => true,
            ],
            [
                'key' => 'description',
                'label' => trans('master.product.props.description'),
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
        return Product::query()
            ->filter([
                'App\QueryFilters\LikeMatch:search,name,description',
            ]);
    }

    public function paginate(Request $request): AnonymousResourceCollection
    {
        $sort = $this->getSort($this->allowedSorts, $this->defaultSort);
        $order = $this->getOrder($this->defaultOrder);
        $perPage = $this->getPageLength();
        $currentPage = $this->getCurrentPage();

        return ProductResource::collection($this->filter($request)
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
