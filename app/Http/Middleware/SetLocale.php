<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        try {
            // Determine the locale from the request
            $locale = $request->locale ?? config('app.locale');

            // Set the locale for the current request
            app()->setLocale($locale);

            return $next($request);
        } catch (\Exception $e) {
            // Log and handle the exception if necessary
            \Log::error($e);

            return response()->error('An error occurred while setting locale.', 500);
        }
    }
}
