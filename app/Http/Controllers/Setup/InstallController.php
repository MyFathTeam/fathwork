<?php

namespace App\Http\Controllers\Setup;

use App\Actions\Setup\Install;
use App\Http\Controllers\Controller;
use App\Http\Requests\Setup\InstallRequest;
use App\Services\Setup\InstallService;

class InstallController extends Controller
{
    /**
     * Get pre requisites of server and folder
     */
    public function preRequisite(InstallService $install)
    {
        return response()->ok($install->preRequisite());
    }

    /**
     * Install the application
     */
    public function store(InstallRequest $request, Install $install)
    {
        $request->validateDatabase();

        if (in_array(request()->query('option'), ['db', 'user', 'license'])) {
            return response()->success([]);
        }

        $install->execute();

        return response()->success(['message' => trans('setup.install.completed')]);
    }
}
