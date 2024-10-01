<?php

namespace App\Models\Config;

use App\Concerns\HasFilter;
use App\Concerns\HasUuid;
use App\Http\Resources\Config\RoleResource;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Role extends Model
{
    use HasFilter, HasUuid, LogsActivity;

    protected $fillable = [];

    protected $primaryKey = 'id';

    protected $table = 'roles';

    public static function selectOption()
    {
        return RoleResource::collection(self::when(! \Auth::user()->is_default, function ($q) {
            $q->whereNotIn('name', ['admin']);
        })->get());
    }

    public static function getRolesForPermission()
    {
        return RoleResource::collection(self::whereNotIn('name', ['admin'])->get());
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('role')
            ->logAll()
            ->logExcept(['updated_at'])
            ->logOnlyDirty();
    }
}
