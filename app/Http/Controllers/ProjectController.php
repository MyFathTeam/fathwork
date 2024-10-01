<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Services\ProjectListService;
use App\Services\ProjectService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request, ProjectListService $service)
    {
        return $service->paginate($request);
    }

    public function store(ProjectRequest $request, ProjectService $service)
    {
        $project = $service->create($request);

        return response()->success([
            'message' => trans('global.created', ['attribute' => trans('project.project')]),
            'project' => ProjectResource::make($project),
        ]);
    }

    public function show(Project $project): ProjectResource
    {
        $project->load('media');

        return ProjectResource::make($project);
    }

    public function update(ProjectRequest $request, Project $project, ProjectService $service)
    {
        $service->update($request, $project);

        return response()->success([
            'message' => trans('global.updated', ['attribute' => trans('project.project')]),
        ]);
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return response()->success([
            'message' => trans('global.deleted', ['attribute' => trans('project.project')]),
        ]);
    }

    public function download(Project $project, $uuid)
    {
        return $project->downloadMedia($uuid);
    }
}
