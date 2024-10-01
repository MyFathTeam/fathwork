<?php

namespace App\Actions\Setup;

use Illuminate\Pipeline\Pipeline;

class Install
{
    public function execute()
    {
        $results = app(Pipeline::class)
            ->send(request()->all())
            ->through([
                SetENV::class,
                Migrate::class,
                SeedRoleAndPermission::class,
                SeedConfig::class,
                SeedUser::class,
                Setup::class,
                GenerateSymlink::class,
                SetAppInstallation::class,
            ])
            ->thenReturn();
    }
}
