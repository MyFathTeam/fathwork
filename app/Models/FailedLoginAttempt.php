<?php

namespace App\Models;

use App\Concerns\HasFilter;
use App\Concerns\HasMeta;
use App\Concerns\HasUuid;
use Illuminate\Database\Eloquent\Model;

class FailedLoginAttempt extends Model
{
    use HasFilter, HasUuid, HasMeta;

    protected $fillable = [];

    protected $primaryKey = 'id';

    protected $hidden = [
        'password',
    ];

    protected $table = 'failed_login_attempts';

    protected $casts = [
        'meta' => 'array',
    ];
}
