<?php

namespace App\Services\Master;

use App\Models\Master\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryService
{
    public function create(Request $request): ProductCategory
    {
        $productcategory = ProductCategory::forceCreate($this->formatParams($request));

        return $productcategory;
    }

    private function formatParams(Request $request, ?ProductCategory $productcategory = null): array
    {
        return [
            'title' => $request->title,
            'slug' => strtolower(str_replace(' ','-',$request->title)),
        ];
    }

    public function update(Request $request, ProductCategory $productcategory): void
    {
        $productcategory->forceFill($this->formatParams($request, $productcategory))->save();

    }

    public function deletable(ProductCategory $productcategory): void
    {
    }
}
