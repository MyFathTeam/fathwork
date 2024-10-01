<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UnderMaintenance
{
    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (config('config.system.enable_maintenance_mode') && \Auth::check() && ! \Auth::user()->is_default) {
            \Auth::user()->logout();
            throw ValidationException::withMessages(['message' => __('general.errors.invalid_action')]);
        }

        return $next($request);
    }
}
