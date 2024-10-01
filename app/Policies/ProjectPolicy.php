<?php

namespace App\Policies;

use App\Models\Project;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the project can get pre-requisite.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function preRequisite(Project $project)
    {
        return $project->hasAnyPermission(['project:read', 'project:create', 'project:edit']);
    }

    /**
     * Determine whether the project can view any models.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Project $project)
    {
        return $project->can('project:read');
    }

    /**
     * Determine whether the project can view the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Project $project, Project $model)
    {
        return $project->can('project:read');
    }

    /**
     * Determine whether the project can create models.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Project $project)
    {
        return $project->can('project:create');
    }

    /**
     * Determine whether the project can update the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Project $project, Project $model)
    {
        if (! $project->can('project:edit')) {
            return false;
        }

        return $model->isEditable();
    }

    /**
     * Determine whether the project can delete the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Project $project, Project $model)
    {
        if (! $project->can('project:delete')) {
            return false;
        }

        return $model->isEditable();
    }

    /**
     * Determine whether the project can restore the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Project $project, Project $model)
    {
        //
    }

    /**
     * Determine whether the project can permanently delete the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Project $project, Project $model)
    {
        //
    }
}
