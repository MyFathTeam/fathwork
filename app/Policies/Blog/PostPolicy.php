<?php

namespace App\Policies\Blog;

use App\Models\Blog\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the post can get pre-requisite.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function preRequisite(Post $post)
    {
        return $post->hasAnyPermission(['post:read', 'post:create', 'post:edit']);
    }

    /**
     * Determine whether the post can view any models.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Post $post)
    {
        return $post->can('post:read');
    }

    /**
     * Determine whether the post can view the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Post $post, Post $model)
    {
        if (! $model->can('post:read')) {
            return false;
        }

        return $model->isEditable();
    }


    /**
     * Determine whether the post can create models.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Post $post)
    {
        if (! $post->can('post:create')) {
            return false;
        }

        return $post->isEditable();
    }

    /**
     * Determine whether the post can update the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Post $post, Post $model)
    {
        if (! $post->can('post:edit')) {
            return false;
        }

        return $model->isEditable();
    }

    /**
     * Determine whether the post can delete the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Post $post, Post $model)
    {
        if (! $post->can('post:delete')) {
            return false;
        }

        return $model->isEditable();
    }

    /**
     * Determine whether the post can restore the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Post $post, Post $model)
    {
        //
    }

    /**
     * Determine whether the post can permanently delete the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Post $post, Post $model)
    {
        //
    }
}
