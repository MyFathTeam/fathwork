<?php

namespace App\Services\Config;

use App\Models\Config\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class RoleService
{
    public function create(Request $request): Role
    {
        return Role::forceCreate([
            'name' => strtolower($request->name),
            'uuid' => (string) Str::uuid(),
            'guard_name' => 'web',
        ]);
    }

    public function deletable(Role $role): void
    {
        $permission = Arr::getVar('permission');
        $roles = Arr::get($permission, 'roles', []);

        if (in_array(strtolower($role->name), $roles)) {
            throw ValidationException::withMessages(['message' => trans('global.could_not_delete_default', ['attribute' => trans('config.role.role')])]);
        }
    }
}
