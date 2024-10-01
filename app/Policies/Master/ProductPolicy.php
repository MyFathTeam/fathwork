<?php

namespace App\Policies\Master;

use App\Models\Master\Product;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the product can get pre-requisite.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function preRequisite(Product $product)
    {
        return $product->hasAnyPermission(['product:read', 'product:create', 'product:edit']);
    }

    /**
     * Determine whether the product can view any models.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Product $product)
    {
        return $product->can('product:read');
    }

    /**
     * Determine whether the product can view the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Product $product, Product $model)
    {
        if (! $model->can('product:read')) {
            return false;
        }

        return $model->isEditable();
    }


    /**
     * Determine whether the product can create models.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Product $product)
    {
        if (! $product->can('product:create')) {
            return false;
        }

        return $product->isEditable();
    }

    /**
     * Determine whether the product can update the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Product $product, Product $model)
    {
        if (! $product->can('product:edit')) {
            return false;
        }

        return $model->isEditable();
    }

    /**
     * Determine whether the product can delete the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Product $product, Product $model)
    {
        if (! $product->can('product:delete')) {
            return false;
        }

        return $model->isEditable();
    }

    /**
     * Determine whether the product can restore the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Product $product, Product $model)
    {
        //
    }

    /**
     * Determine whether the product can permanently delete the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Product $product, Product $model)
    {
        //
    }
}
