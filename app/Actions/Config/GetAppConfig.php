<?php

namespace App\Actions\Config;

use App\Support\BuildConfig;
use Closure;

class GetAppConfig
{
    use BuildConfig;

    public function handle($config, Closure $next)
    {
        $config = $this->generate(
            config: $config,
            mask: true,
            showPublic: \Auth::check() ? false : true,
        );

        return $next($config);
    }
}
