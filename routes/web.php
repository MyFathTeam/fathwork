<?php

use App\Http\Controllers\Auth\OAuthController;
use App\Http\Controllers\Config\MailTemplateController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SignedMediaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaththinkController;
use App\Http\Controllers\SensorDataController;

Route::post('/sensor-data', [SensorDataController::class, 'store']);

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/faththink', [FaththinkController::class, 'index']);
Route::get('/fathink', [FaththinkController::class, 'fathink'])->name('fathink');
Route::post('/add-data', [FaththinkController::class, 'addData'])->name('addData');

// Route::get('/', HomeController::class)->middleware('site')->name('home');
Route::get('/', [HomeController::class, 'index'])->name('/');
Route::get('/products', [HomeController::class, 'products'])->name('products');
Route::get('/posts', [HomeController::class, 'posts'])->name('posts');
Route::get('/projects', [HomeController::class, 'projects'])->name('projects');
Route::get('/products/detail/{uuid}', [HomeController::class, 'productdetail'])->name('productdetail');
Route::get('/posts/detail/{uuid}', [HomeController::class, 'postdetail'])->name('postdetail');
Route::get('/projects/detail/{uuid}', [HomeController::class, 'projectdetail'])->name('projectdetail');
Route::get('/show-demo', [HomeController::class, 'demo'])->name('demo');

//kirim data dari arduino
Route::get('/faththinks', [FaththinkController::class, 'data']);

Route::get('/dataarduino', [FaththinkController::class, 'slide']);


Route::get('/app/config/mail-template/{mail_template}', [MailTemplateController::class, 'detail'])
    ->name('config.mail-template.detail')
    ->middleware('permission:config:store');

Route::get('/media/{media}/{conversion?}', SignedMediaController::class)->name('media');
Route::get('/auth/{provider}/redirect', [OAuthController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [OAuthController::class, 'callback']);

Route::redirect('/log', 'log-viewer', 301);

// app route
Route::get('/app/{vue?}', function () {
    return view('app');
})->where('vue', '[\/\w\.-]*')->name('app');

// Fallback route
Route::fallback(function () {
    abort(404);
});
