<?php

namespace App\Services\Config;

use App\Http\Resources\Config\RoleResource;
use App\Models\Config\Permission;
use App\Models\Config\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Role as SpatieRole;

class PermissionService
{
    public function preRequisite(Request $request): array
    {
        $roles = $this->getRoles();

        $modules = $this->getModules();

        $selectedModule = $this->getSelectedModule($request->query('type'));

        $permissions = $this->getModulePermission($selectedModule);

        $assignedPermissions = $this->generatePermissionInput($permissions, $roles);

        return compact('roles', 'modules', 'selectedModule', 'assignedPermissions');
    }

    public function roleWiseAssign(Request $request): void
    {
        $roles = $this->getRoles();

        $selectedModule = $this->getSelectedModule($request->selected_module);

        $permissions = $this->getModulePermission($selectedModule);

        $this->assignPermission($request, $permissions, $roles);
    }

    public function userWiseAssign(Request $request): void
    {
        $users = User::whereIn('uuid', $request->users)->get();

        $permissions = Permission::whereIn('name', $request->permissions)->get()->pluck('name')->all();

        foreach ($users as $user) {
            if ($request->action === 'assign') {
                $user->givePermissionTo($permissions);
            } else {
                $user->revokePermissionTo($permissions);
            }
        }
    }

    private function getRoles(): AnonymousResourceCollection
    {
        $roles = Role::getRolesForPermission();

        $spatieRoles = SpatieRole::with('permissions')->whereIn('name', $roles->pluck('name')->all())->get();

        return RoleResource::collection($spatieRoles);
    }

    private function getSelectedModule($selection = null): string
    {
        $acl = Arr::getVar('permission');
        $groupPermissions = Arr::get($acl, 'permissions');
        $moduleList = array_keys($groupPermissions);

        return in_array($selection, $moduleList) ? $selection : Arr::first($moduleList);
    }

    private function getModules(): array
    {
        $acl = Arr::getVar('permission');
        $groupPermissions = Arr::get($acl, 'permissions');

        return collect($groupPermissions)->keys()->map(function ($item) {
            return ['label' => trans('module.'.$item), 'value' => $item];
        })->toArray();
    }

    private function getModulePermission($selectedModule): array
    {
        $acl = Arr::getVar('permission');
        $groupPermissions = Arr::get($acl, 'permissions');

        return array_keys(Arr::get($groupPermissions, $selectedModule, []));
    }

    private function generatePermissionInput($permissions = [], $roles = []): array
    {
        $assignedPermissions = [];
        foreach ($permissions as $permission) {
            $rows = [];
            foreach ($roles as $role) {
                $isAssigned = $role->permissions->firstWhere('name', $permission);

                $rows[] = [
                    'label' => title_case($role->name),
                    'name' => $role->name,
                    'is_assigned' => $isAssigned ? true : false,
                ];
            }

            $assignedPermissions[] = [
                'name' => $permission,
                'roles' => $rows,
            ];
        }

        return $assignedPermissions;
    }

    private function assignPermission(Request $request, $permissions = [], $roles = []): void
    {
        foreach ($roles as $role) {
            $newPermissions = [];
            foreach ($request->assigned_permissions as $assigned_permission) {
                $role_permission = Arr::first($assigned_permission['roles'], function ($item) use ($role) {
                    return $item['name'] === $role->name && $item['is_assigned'];
                });

                if ($role_permission) {
                    $newPermissions[] = Arr::get($assigned_permission, 'name');
                }
            }

            $role->revokePermissionTo($permissions);
            $role->givePermissionTo($newPermissions);
        }
    }
}
