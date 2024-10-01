<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\ProductRequest;
use App\Http\Resources\Master\ProductResource;
use App\Models\Master\Product;
use App\Services\Master\ProductListService;
use App\Services\Master\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function preRequisite(Request $request, ProductService $service)
    {
        return response()->ok($service->preRequisite($request));
    }

    public function index(Request $request, ProductListService $service)
    {
        return $service->paginate($request);
    }

    public function store(ProductRequest $request, ProductService $service)
    {
        $product = $service->create($request);

        return response()->success([
            'message' => trans('global.created', ['attribute' => trans('master.product.product')]),
            'product' => ProductResource::make($product),
        ]);
    }

    public function show(Product $product): ProductResource
    {
        $product->load('media');

        return ProductResource::make($product);
    }

    public function update(ProductRequest $request, Product $product, ProductService $service)
    {
        $service->update($request, $product);

        return response()->success([
            'message' => trans('global.updated', ['attribute' => trans('master.product.product')]),
        ]);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->success([
            'message' => trans('global.deleted', ['attribute' => trans('master.product.product')]),
        ]);
    }

    public function download(Product $product, $uuid)
    {
        return $product->downloadMedia($uuid);
    }
}
