<?php

namespace App\Policies;

use App\Models\Faththink;
use Illuminate\Auth\Access\HandlesAuthorization;

class FaththinkPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the faththink can get pre-requisite.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function preRequisite(Faththink $faththink)
    {
        return $faththink->hasAnyPermission(['faththink:read', 'faththink:create', 'faththink:edit']);
    }

    /**
     * Determine whether the faththink can view any models.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Faththink $faththink)
    {
        return $faththink->can('faththink:read');
    }

    /**
     * Determine whether the faththink can view the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Faththink $faththink, Faththink $model)
    {
        return $faththink->can('faththink:read');
    }

    /**
     * Determine whether the faththink can create models.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Faththink $faththink)
    {
        return $faththink->can('faththink:create');
    }

    /**
     * Determine whether the faththink can update the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Faththink $faththink, Faththink $model)
    {
        if (!$faththink->can('faththink:edit')) {
            return false;
        }

        return $model->isEditable();
    }

    /**
     * Determine whether the faththink can delete the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Faththink $faththink, Faththink $model)
    {
        if (!$faththink->can('faththink:delete')) {
            return false;
        }

        return $model->isEditable();
    }

    /**
     * Determine whether the faththink can restore the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Faththink $faththink, Faththink $model)
    {
        //
    }

    /**
     * Determine whether the faththink can permanently delete the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Faththink $faththink, Faththink $model)
    {
        //
    }
}
