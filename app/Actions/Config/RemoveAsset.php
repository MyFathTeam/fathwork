<?php

namespace App\Actions\Config;

use App\Concerns\HasStorage;
use App\Models\Config\Config;
use Illuminate\Http\Request;

class RemoveAsset
{
    use HasStorage;

    public function execute(Request $request)
    {
        $asset = config('config.assets.'.$request->query('type'));

        $this->deleteFile(
            visibility: 'public',
            path: $asset,
        );

        $config = Config::firstOrCreate(['name' => 'assets']);
        $config->resetValue([$request->query('type')]);
        $config->save();

        cache()->forget('query_config_list_all');
    }
}
