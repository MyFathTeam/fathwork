<?php

namespace App\Policies\Blog;

use App\Models\Master\ProductCategory;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductCategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the productcategory can get pre-requisite.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function preRequisite(ProductCategory $productcategory)
    {
        return $productcategory->hasAnyPermission(['productcategory:read', 'productcategory:create', 'productcategory:edit']);
    }

    /**
     * Determine whether the productcategory can view any models.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(ProductCategory $productcategory)
    {
        return $productcategory->can('productcategory:read');
    }

    /**
     * Determine whether the productcategory can view the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(ProductCategory $productcategory, ProductCategory $model)
    {
        if (! $model->can('productcategory:read')) {
            return false;
        }

        return $model->isEditable();
    }


    /**
     * Determine whether the productcategory can create models.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(ProductCategory $productcategory)
    {
        if (! $productcategory->can('productcategory:create')) {
            return false;
        }

        return $productcategory->isEditable();
    }

    /**
     * Determine whether the productcategory can update the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(ProductCategory $productcategory, ProductCategory $model)
    {
        if (! $productcategory->can('productcategory:edit')) {
            return false;
        }

        return $model->isEditable();
    }

    /**
     * Determine whether the productcategory can delete the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(ProductCategory $productcategory, ProductCategory $model)
    {
        if (! $productcategory->can('productcategory:delete')) {
            return false;
        }

        return $model->isEditable();
    }

    /**
     * Determine whether the productcategory can restore the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(ProductCategory $productcategory, ProductCategory $model)
    {
        //
    }

    /**
     * Determine whether the productcategory can permanently delete the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(ProductCategory $productcategory, ProductCategory $model)
    {
        //
    }
}
