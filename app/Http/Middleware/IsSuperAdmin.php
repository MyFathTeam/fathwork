<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsSuperAdmin
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

        if (! \Auth::user()->is_default) {
            return response()->json(['message' => __('user.errors.permission_denied')], 403);
        }

        return $next($request);
    }
}
