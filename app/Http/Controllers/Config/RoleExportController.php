<?php

namespace App\Http\Controllers\Config;

use App\Http\Controllers\Controller;
use App\Services\Config\RoleListService;
use Illuminate\Http\Request;

class RoleExportController extends Controller
{
    public function __invoke(Request $request, RoleListService $service)
    {
        $list = $service->list($request);

        return $service->export($list);
    }
}
