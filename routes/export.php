<?php

use App\Http\Controllers\Blog\PostCategoryExportController;
use App\Http\Controllers\Blog\PostController;
use App\Http\Controllers\Blog\PostExportController;
use App\Http\Controllers\Config\RoleExportController;
use App\Http\Controllers\Master\ProductController;
use App\Http\Controllers\Master\ProductExportController;
use App\Http\Controllers\OptionExportController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectExportController;
use App\Http\Controllers\Master\ProductCategoryExportController;
use App\Http\Controllers\UserExportController;
use App\Http\Controllers\Utility\ActivityLogExportController;
use App\Http\Controllers\Utility\BackupExportController;
use App\Http\Controllers\Utility\TodoExportController;
use Illuminate\Support\Facades\Route;

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

// export route
Route::get('config/roles/export', RoleExportController::class)->middleware('permission:config:store');
Route::get('utility/todos/export', TodoExportController::class)->middleware('permission:todo:export');
Route::get('utility/activity-logs/export', ActivityLogExportController::class)->middleware('permission:activity-log:export');
Route::get('utility/backups/export', BackupExportController::class)->middleware('permission:backup:manage');
Route::get('users/export', UserExportController::class)->middleware('permission:user:export');
Route::get('options/export', OptionExportController::class)->middleware('option.verifier');

Route::get('projects/{project}/public/{uuid}', [ProjectController::class, 'download']);
Route::get('projects/export', ProjectExportController::class);
Route::get('master/productcategories/export', ProductCategoryExportController::class);
Route::get('master/products/{product}/public/{uuid}', [ProductController::class, 'download']);
Route::get('blog/products/export', ProductExportController::class);
Route::get('blog/postcategories/export', PostCategoryExportController::class);
Route::get('blog/posts/{post}/public/{uuid}', [PostController::class, 'download']);
Route::get('blog/posts/export', PostExportController::class);
