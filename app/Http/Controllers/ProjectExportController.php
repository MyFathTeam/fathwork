<?php

namespace App\Http\Controllers;

use App\Services\ProjectListService;
use Illuminate\Http\Request;

class ProjectExportController extends Controller
{
    public function __invoke(Request $request, ProjectListService $service)
    {
        $list = $service->list($request);

        return $service->export($list);
    }
}
