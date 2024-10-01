<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\ProductCategoryRequest;
use App\Http\Resources\Master\ProductCategoryResource;
use App\Models\Master\ProductCategory;

use App\Services\Master\ProductCategoryListService;
use App\Services\Master\ProductCategoryService;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function index(Request $request, ProductCategoryListService $service)
    {
        return $service->paginate($request);
    }

    public function store(ProductCategoryRequest $request, ProductCategoryService $service)
    {
        $productcategory = $service->create($request);

        return response()->success([
            'message' => trans('global.created', ['attribute' => trans('master.productcategory.productcategory')]),
            'productcategory' => ProductCategoryResource::make($productcategory),
        ]);
    }

    public function show(ProductCategory $productcategory): ProductCategoryResource
    {
        return ProductCategoryResource::make($productcategory);
    }

    public function update(ProductCategoryRequest $request, ProductCategory $productcategory, ProductCategoryService $service)
    {
        $service->update($request, $productcategory);

        return response()->success([
            'message' => trans('global.updated', ['attribute' => trans('master.productcategory.productcategory')]),
        ]);
    }

    public function destroy(ProductCategory $productcategory)
    {
        $productcategory->delete();

        return response()->success([
            'message' => trans('global.deleted', ['attribute' => trans('master.productcategory.productcategory')]),
        ]);
    }

    public function download(ProductCategory $productcategory, $uuid)
    {
        return $productcategory->downloadMedia($uuid);
    }
}
