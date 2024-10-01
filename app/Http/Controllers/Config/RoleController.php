<?php

namespace App\Http\Controllers\Config;

use App\Http\Controllers\Controller;
use App\Http\Requests\Config\RoleRequest;
use App\Http\Resources\Config\RoleResource;
use App\Models\Config\Role;
use App\Services\Config\RoleListService;
use App\Services\Config\RoleService;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(Request $request, RoleListService $service)
    {
        return $service->paginate($request);
    }

    public function store(RoleRequest $request, RoleService $service)
    {
        $role = $service->create($request);

        return response()->success([
            'message' => trans('global.created', ['attribute' => trans('config.role.role')]),
            'role' => RoleResource::make($role),
        ]);
    }

    public function show(Role $role): RoleResource
    {
        return RoleResource::make($role);
    }

    public function destroy(Role $role, RoleService $service)
    {
        $service->deletable($role);

        $role->delete();

        return response()->success([
            'message' => trans('global.deleted', ['attribute' => trans('config.role.role')]),
        ]);
    }
}
