<?php

namespace App\Http\Controllers\Config;

use App\Actions\UserSearch;
use App\Http\Controllers\Controller;
use App\Http\Requests\Config\UserWisePermissionRequest;
use App\Http\Resources\UserResource;
use App\Services\Config\PermissionSearchService;
use App\Services\Config\PermissionService;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function preRequisite(Request $request, PermissionService $service)
    {
        return response()->ok($service->preRequisite($request));
    }

    public function roleWiseAssign(Request $request, PermissionService $service)
    {
        $service->roleWiseAssign($request);

        return response()->success([
            'message' => __('global.assigned', ['attribute' => __('config.permission.permission')]),
        ]);
    }

    public function search(Request $request, PermissionSearchService $service)
    {
        return response()->ok($service->search($request));
    }

    public function searchUser(Request $request, UserSearch $action)
    {
        return UserResource::collection($action->execute($request));
    }

    public function userWiseAssign(UserWisePermissionRequest $request, PermissionService $service)
    {
        $service->userWiseAssign($request);

        return response()->success([
            'message' => __('global.assigned', ['attribute' => __('config.permission.permission')]),
        ]);
    }
}
