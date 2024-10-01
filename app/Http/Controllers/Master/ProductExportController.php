<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Services\Master\ProductListService;
use Illuminate\Http\Request;

class ProductExportController extends Controller
{
    public function __invoke(Request $request, ProductListService $service)
    {
        $list = $service->list($request);

        return $service->export($list);
    }
}
