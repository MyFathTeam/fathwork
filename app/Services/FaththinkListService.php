<?php

namespace App\Services;

use App\Contracts\ListGenerator;
use App\Http\Resources\FaththinkResource;
use App\Models\Faththink;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class FaththinkListService extends ListGenerator
{
    protected $allowedSorts = ['created_at', 'humidity, temperature, soil_moisture'];

    public function getHeaders(): array
    {
        $headers = [
            [
                'key' => 'humidity',
                'label' => trans('faththink.mantap.props.humidity'),
                'sortable' => true,
                'visibility' => true,
            ],
            [
                'key' => 'temperature',
                'label' => trans('faththink.mantap.props.temperature'),
                'sortable' => true,
                'visibility' => true,
            ],
            [
                'key' => 'soil_moisture',
                'label' => trans('faththink.mantap.props.soil_moisture'),
                'sortable' => true,
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
        return Faththink::query()
            ->filter([
                'App\QueryFilters\LikeMatch:search,humidity, temperature, soil_moisture ',
            ]);
    }

    public function paginate(Request $request): AnonymousResourceCollection
    {
        $sort = $this->getSort($this->allowedSorts, $this->defaultSort);
        $order = $this->getOrder($this->defaultOrder);
        $perPage = $this->getPageLength();
        $currentPage = $this->getCurrentPage();

        return FaththinkResource::collection($this->filter($request)
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
