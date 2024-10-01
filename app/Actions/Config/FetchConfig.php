<?php

namespace App\Actions\Config;

use App\Models\Config\Config;
use App\Support\BuildConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class FetchConfig
{
    use BuildConfig;

    public function execute(Request $request)
    {
        $config = $this->generate(
            config: Config::listAll(),
            mask: true,
            showPublic: false,
        );

        $config['system']['currencies'] = explode(',', Arr::get($config, 'system.currencies'));

        return Arr::get($config, $request->query('type'));
    }
}
