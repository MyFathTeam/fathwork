<?php

namespace App\Models\Config;

use App\Concerns\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasUuid;

    protected $fillable = [];

    protected $primaryKey = 'id';

    protected $table = 'permissions';
}
