<?php

namespace App\Services;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectService
{
    public function create(Request $request): Project
    {
        $project = Project::forceCreate($this->formatParams($request));

        $project->addMedia($request);

        return $project;
    }

    private function formatParams(Request $request, ?Project $project = null): array
    {
        return [
            'title' => $request->title,
            'slug' => strtolower(str_replace(' ','-',$request->title)),
            'description' => $request->description,
        ];
    }

    public function update(Request $request, Project $project): void
    {
        $project->forceFill($this->formatParams($request, $project))->save();

        $project->updateMedia($request);
    }

    public function deletable(Project $project): void
    {
    }
}
