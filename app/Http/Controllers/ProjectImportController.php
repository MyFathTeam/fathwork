<?php

namespace App\Http\Controllers;

use App\Services\ProjectImportService;
use Illuminate\Http\Request;

class ProjectImportController extends Controller
{
    public function __invoke(Request $request, ProjectImportService $service)
    {
        $service->import($request);

        if (request()->boolean('validate')) {
            return response()->success([
                'message' => trans('general.data_validated'),
            ]);
        }

        return response()->success([
            'imported' => true,
            'message' => trans('global.imported', ['attribute' => trans('project.project')]),
        ]);
    }
}
