<?php

namespace App\Actions\Config;

use App\Concerns\HasStorage;
use App\Models\Config\Config;
use Illuminate\Http\Request;

class UploadAsset
{
    use HasStorage;

    public function execute(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
        ]);

        $asset = config('config.assets.'.$request->query('type'));

        $this->deleteFile(
            visibility: 'public',
            path: $asset
        );

        $image = $this->uploadFile(
            visibility: 'public',
            path: 'assets/'.$request->query('type'),
            input: 'image',
            url: false
        );

        $config = Config::firstOrCreate(['name' => 'assets']);
        $config->setValue([$request->query('type') => $image]);
        $config->save();

        cache()->forget('query_config_list_all');
    }
}
