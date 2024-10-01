<?php

namespace App\Models\Master;

use App\Concerns\HasFilter;
use App\Concerns\HasMedia;
use App\Concerns\HasMeta;
use App\Concerns\HasUuid;
use App\Contracts\Mediable;
use App\Models\Master\ProductCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Product extends Model implements Mediable
{
    use HasFactory, HasFilter, HasUuid, HasMeta, HasMedia, HasRoles;

    protected $fillable = [];

    protected $primaryKey = 'id';

    protected $table = 'products';

    protected $casts = [
        'meta' => 'array',
    ];

    public function getModelName(): string
    {
        return 'Product';
    }

    /**
     * Get the user that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productcategory()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function isEditable()
    {
        if ($this->getMeta('is_default')) {
            return false;
        }

        if (! Auth::user()->is_default && $this->hasRole('admin')) {
            return false;
        }

        // if ($this->id == \Auth::id()) {
        //     return false;
        // }

        return true;
    }
}
