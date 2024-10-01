<?php

use App\Http\Controllers\ApiMobile\ApiMobileController;
use App\Http\Controllers\Config\ConfigController;
use App\Http\Controllers\Setup\InstallController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KirimDataController;
use App\Http\Controllers\FaththinkController;
use App\Http\Controllers\SensorDataController;

Route::post('/sensor-data', [SensorDataController::class, 'store']);



Route::post('/kirimdata', [FaththinkController::class, 'store']);


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Global Routes
Route::get('config/pre-requisite', [ConfigController::class, 'preRequisite'])->name('config.preRequisite');
Route::get('config', [ConfigController::class, 'index'])->name('config');

Route::get('install/pre-requisite', [InstallController::class, 'preRequisite'])->name('install.preRequisite');
Route::post('install/validate', [InstallController::class, 'store'])->name('install.validate');
Route::post('install', [InstallController::class, 'store'])->name('install.store');

// Fallback route
Route::fallback(function () {
    return response()->json(['message' => trans('general.errors.api_not_found')], 404);
});


// Mobile Routes
Route::get('test-mobile', [ApiMobileController::class, 'testMobile'])->name('test.mobile');
