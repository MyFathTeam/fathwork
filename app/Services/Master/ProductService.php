<?php

namespace App\Services\Master;

use App\Models\Master\Product;
use App\Models\Master\ProductCategory;
use Illuminate\Http\Request;

class ProductService
{
    public function preRequisite(): array
    {
        $list = ProductCategory::get();
        $productcategory = [];
        foreach ($list as $item => $value) {
            $productcategory[] = ['value' => $value->id, 'label' => $value->title];
        }
        return compact('productcategory');
    }
    
    public function create(Request $request): Product
    {
        $product = Product::forceCreate($this->formatParams($request));

        $product->addMedia($request);

        return $product;
    }

    private function formatParams(Request $request, ?Product $product = null): array
    {
        return [
            'name' => $request->name,
            'slug' => strtolower(str_replace(' ','-',$request->name)),
            'product_category_id' => $request->productcategory,
            'description' => $request->description,
        ];
    }

    public function update(Request $request, Product $product): void
    {
        $product->forceFill($this->formatParams($request, $product))->save();

        $product->updateMedia($request);
    }

    public function deletable(Product $product): void
    {
    }
}
