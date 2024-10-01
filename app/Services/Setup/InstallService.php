<?php

namespace App\Services\Setup;

use App\Helpers\SysHelper;
use App\Support\ServerPreRequisite;

class InstallService
{
    use ServerPreRequisite;

    public function preRequisite()
    {
        $preRequisites = $this->getPreRequisite();

        $app = [
            'title' => config('app.name'),
            'version' => SysHelper::getApp('VERSION'),
            'subtitle' => trans('setup.install.install_wizard'),
        ];

        return compact('preRequisites', 'app');
    }
}
