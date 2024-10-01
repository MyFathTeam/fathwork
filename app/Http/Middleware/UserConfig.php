<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserConfig
{
    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (empty(auth()->check())) {
            return $next($request);
        }

        config([
            'config.display_timezone' => \Auth::user()->timezone ?? config('config.system.timezone'),
            'config.system.locale' => \Auth::user()->getPreference('system.locale') ?? config('config.system.locale'),
        ]);

        return $next($request);
    }
}
