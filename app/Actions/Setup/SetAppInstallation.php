<?php

namespace App\Actions\Setup;

use App\Helpers\SysHelper;
use Closure;
use Illuminate\Support\Str;

class SetAppInstallation
{
    public function handle($params, Closure $next)
    {
        SysHelper::setApp(['INSTALLED' => Str::random(10)]);

        return $next($params);
    }
}
