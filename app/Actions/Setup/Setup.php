<?php

namespace App\Actions\Setup;

use Closure;

class Setup
{
    public function handle($params, Closure $next)
    {
        return $next($params);
    }
}
