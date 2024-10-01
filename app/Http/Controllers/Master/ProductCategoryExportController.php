<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Services\Master\ProductCategoryListService;
use Illuminate\Http\Request;

class ProductCategoryExportController extends Controller
{
    public function __invoke(Request $request, ProductCategoryListService $service)
    {
        $list = $service->list($request);

        return $service->export($list);
    }
}
