<?php

use App\Helpers\SysHelper;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use function Pest\Laravel\postJson;

uses(RefreshDatabase::class);

uses()->group('already_installation');

dataset('alreadyInstalledFormData', [
    'default' => [
        [
            'db_host' => 'localhost',
            'db_port' => 3306,
            'db_name' => 'testing',
            'db_username' => 'root',
            'db_password' => 'password',
            'name' => 'John Doe',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'access_code' => 'JFW73VZn8x',
            'registered_email' => 'hi@fathforce.com',
        ],
    ],
]);

test('user cannot install if already installed', function (array $data) {
    SysHelper::setApp(['INSTALLED' => Str::random(6)]);

    $response = installApp($data);

    expect($response->status())->toBe(422);
    expect($response->json('errors'))->toHaveKey('message');
})->with('alreadyInstalledFormData');

function installApp(array $data = [])
{
    return postJson(route('install.store'), $data);
}
