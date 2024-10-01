<?php

namespace App\Actions\Setup;

use Closure;

class SeedRoleAndPermission
{
    public function handle($params, Closure $next)
    {
        \Artisan::call('db:seed', ['--class' => 'RoleSeeder', '--force' => true]);
        \Artisan::call('db:seed', ['--class' => 'PermissionSeeder', '--force' => true]);
        \Artisan::call('db:seed', ['--class' => 'AssignPermissionSeeder', '--force' => true]);

        return $next($params);
    }
}
