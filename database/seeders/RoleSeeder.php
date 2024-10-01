<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $acl = Arr::getVar('permission');

        $existing_roles = Role::get()->pluck('name')->all();
        $system_roles = Arr::get($acl, 'roles', []);

        $new_roles = array_diff($system_roles, $existing_roles);

        $insert_roles = [];
        foreach ($new_roles as $role) {
            $insert_roles[] = [
                'uuid' => (string) Str::uuid(),
                'name' => $role,
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Role::insert($insert_roles);

        $existing_roles = Role::get()->pluck('name')->all();
        $removed_roles = array_diff($existing_roles, $system_roles);

        Role::whereIn('name', array_values($removed_roles))->delete();
    }
}
