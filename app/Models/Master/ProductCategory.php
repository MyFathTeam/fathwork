<?php

namespace App\Models\Master;

use App\Concerns\HasFilter;
use App\Concerns\HasMedia;
use App\Concerns\HasMeta;
use App\Concerns\HasUuid;
use App\Contracts\Mediable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;

class ProductCategory extends Model implements Mediable
{
    use HasFactory, HasFilter, HasUuid, HasMeta, HasMedia, HasRoles;

    protected $fillable = [];

    protected $primaryKey = 'id';

    protected $table = 'product_categories';

    protected $casts = [
        'meta' => 'array',
    ];

    public function getModelName(): string
    {
        return 'ProductCategory';
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
