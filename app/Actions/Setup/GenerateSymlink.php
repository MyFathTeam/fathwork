<?php

namespace App\Actions\Setup;

use Closure;

class GenerateSymlink
{
    public function handle($params, Closure $next)
    {
        if (\File::exists(public_path('storage'))) {
            \File::deleteDirectory(public_path('storage'));
        }

        if (! \File::exists(storage_path('app/public'))) {
            \Storage::makeDirectory('public');
        }

        \Artisan::call('storage:link');

        return $next($params);
    }
}
