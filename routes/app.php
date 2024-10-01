<?php

use App\Http\Controllers\Auth\FailedLoginAttemptController;
use App\Http\Controllers\Blog\PostCategoryController;
use App\Http\Controllers\Blog\PostCategoryImportController;
use App\Http\Controllers\Blog\PostController;
use App\Http\Controllers\Blog\PostImportController;
use App\Http\Controllers\Config\ConfigController;
use App\Http\Controllers\Config\LocaleController;
use App\Http\Controllers\Config\MailTemplateController;
use App\Http\Controllers\Config\PermissionController;
use App\Http\Controllers\Config\RoleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\Master\ProductController;
use App\Http\Controllers\Master\ProductImportController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\OptionActionController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\OptionImportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectImportController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\FaththinkController;
use App\Http\Controllers\Master\ProductCategoryController;
use App\Http\Controllers\Master\ProductCategoryImportController;
use App\Http\Controllers\Search;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserActionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Utility\ActivityLogController;
use App\Http\Controllers\Utility\BackupController;
use App\Http\Controllers\Utility\TodoActionController;
use App\Http\Controllers\Utility\TodoController;
use Illuminate\Support\Facades\Route;

// User Routes
Route::prefix('users')->group(function () {
    Route::get('pre-requisite', [UserController::class, 'preRequisite']);
    Route::post('{user}/status', [UserActionController::class, 'status']);
});

Route::apiResource('users', UserController::class);

Route::prefix('user')->group(function () {
    Route::post('preference', [ProfileController::class, 'preference'])
        ->name('preference');
});

Route::middleware('role:admin')->group(function () {
    Route::get('failed-login-attempts', FailedLoginAttemptController::class)
        ->name('failed.login.attempt');
});

Route::prefix('user')->middleware('test.mode.restriction')->group(function () {
    Route::post('password', [ProfileController::class, 'password'])
        ->name('password.change');

    Route::post('profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::post('profile/account', [ProfileController::class, 'account'])
        ->name('profile.account');

    Route::post('profile/verify', [ProfileController::class, 'verify'])
        ->name('profile.verify');

    Route::post('profile/avatar', [ProfileController::class, 'uploadAvatar'])
        ->name('profile.uploadAvatar');

    Route::delete('profile/avatar', [ProfileController::class, 'removeAvatar'])
        ->name('profile.removeAvatar');
});

// Dashboard Routes
Route::get('dashboard/stat', [DashboardController::class, 'stat'])->name('dashboard.stat');
Route::get('dashboard/agenda', [DashboardController::class, 'agenda'])->name('dashboard.agenda');
Route::get('dashboard/chart', [DashboardController::class, 'chart'])->name('dashboard.chart');
Route::get('dashboard/project', [DashboardController::class, 'project'])->name('dashboard.project');
Route::get('dashboard/faththink', [DashboardController::class, 'faththink'])->name('dashboard.faththink');

// Any key search
Route::get('search', Search::class)
    ->name('search');

// Config Routes
Route::prefix('config')->group(function () {
    Route::get('', [ConfigController::class, 'fetch'])
        ->name('config.fetch');

    Route::post('', [ConfigController::class, 'store'])
        ->name('config.store');

    Route::get('mail/test', [ConfigController::class, 'testMailConnection'])
        ->name('config.testMailConnection');
    Route::get('pusher/test', [ConfigController::class, 'testPusherConnection'])
        ->name('config.testPusherConnection');
        Route::post('assets', [ConfigController::class, 'uploadAsset']);
    Route::delete('assets', [ConfigController::class, 'removeAsset']);

    Route::middleware('permission:config:store')->group(function () {
        Route::apiResource('mail-templates', MailTemplateController::class)->only(['index', 'show', 'update']);

        Route::apiResource('roles', RoleController::class)->except(['update']);

        Route::get('permissions/pre-requisite', [PermissionController::class, 'preRequisite']);
        Route::post('permissions/role/assign', [PermissionController::class, 'roleWiseAssign']);
        Route::get('permissions/search', [PermissionController::class, 'search']);
        Route::get('permissions/user/search', [PermissionController::class, 'searchUser']);
        Route::post('permissions/user/assign', [PermissionController::class, 'userWiseAssign']);
    });

    Route::apiResource('locales', LocaleController::class)->middleware('permission:config:store');
});

// Option Routes
Route::prefix('')->group(function () {
    Route::get('options/pre-requisite', [OptionController::class, 'preRequisite'])->name('options.preRequisite')->middleware('option.verifier');
    Route::post('options/import', OptionImportController::class)->middleware('option.verifier');
    Route::post('options/reorder', [OptionActionController::class, 'reorder'])->middleware('option.verifier');
    Route::apiResource('options', OptionController::class)->middleware('option.verifier');

    Route::get('master/products/pre-requisite', [ProductController::class, 'preRequisite']);
    Route::get('blog/posts/pre-requisite', [PostController::class, 'preRequisite']);
});

// Utility Routes
Route::prefix('utility')->group(function () {
    Route::prefix('todos')->middleware('permission:todo:manage')->group(function () {
        Route::get('pre-requisite', [TodoController::class, 'preRequisite'])->name('todos.preRequisite');
        Route::post('{todo}/status', [TodoActionController::class, 'status'])->name('todos.status');
        Route::post('{todo}/archive', [TodoActionController::class, 'archive'])->name('todos.archive');
        Route::post('{todo}/unarchive', [TodoActionController::class, 'unarchive'])->name('todos.unarchive');
        Route::post('reorder', [TodoActionController::class, 'reorder'])->name('todos.reorder');
        Route::post('lists/move', [TodoActionController::class, 'moveList'])->name('todos.moveList');
    });

    Route::post('todos/delete', [TodoController::class, 'destroyMultiple']);
    Route::apiResource('todos', TodoController::class)->middleware('permission:todo:manage');

    Route::apiResource('backups', BackupController::class)->only(['index', 'destroy'])->middleware('permission:backup:manage');

    Route::apiResource('activity-logs', ActivityLogController::class)->only(['index', 'destroy'])->middleware('permission:activity-log:manage');
});

Route::post('/images/upload', [ImageController::class, 'upload'])->name('image.upload');

Route::get('tags', [TagController::class, 'index'])->name('tags.index');

Route::resource('medias', MediaController::class)->only(['store', 'destroy']);

Route::post('projects/import', ProjectImportController::class);
Route::apiResource('projects', ProjectController::class);


Route::apiResource('faththinks', FaththinkController::class);

Route::prefix('master')->group(function () {
    Route::post('products/import', ProductImportController::class);
    Route::apiResource('products', ProductController::class);
    Route::post('productcategories/import', ProductCategoryImportController::class);
    Route::apiResource('productcategories', ProductCategoryController::class);
});
Route::prefix('blog')->group(function () {
    Route::post('posts/import', PostImportController::class);
    Route::apiResource('posts', PostController::class);
    Route::post('postcategories/import', PostCategoryImportController::class);
    Route::apiResource('postcategories', PostCategoryController::class);
});