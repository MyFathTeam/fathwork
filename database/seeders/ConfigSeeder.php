<?php

namespace Database\Seeders;

use App\Models\Config\Config;
use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $config = Config::firstOrCreate(['name' => 'general']);
        $config->value = [
            'app_name' => 'FathCMS Admin | Mint UI',
        ];
        $config->save();

        $config = Config::firstOrCreate(['name' => 'system']);
        $config->value = [
            'enable_dark_theme' => false,
        ];
        $config->save();

        $config = Config::firstOrCreate(['name' => 'notification']);
        $config->value = [
            'enable_pusher_notification' => true,
            'pusher_app_id' => '1469597',
            'pusher_app_key' => '9c7bf2b610b2e226eff2',
            'pusher_app_secret' => '3e9f0a0566a1a52b1c13',
            'pusher_app_cluster' => 'ap2',
        ];
        $config->save();
    }
}
