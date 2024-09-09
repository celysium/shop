<?php

use App\Modules\Panel\Controllers\AuthenticationController;
use App\Modules\Panel\Controllers\BannerController;
use App\Modules\Panel\Controllers\CategoryController;
use App\Modules\Panel\Controllers\WidgetController;
use Illuminate\Support\Facades\Route;

Route::prefix(config('panel.router.prefix'))->name('panel.')->group(function () {

    Route::name('auth.')->prefix('auth')->group(function () {
        Route::post('login', [AuthenticationController::class, 'login'])->name('login');
        Route::post('forget', [AuthenticationController::class, 'forget'])->name('forget');
        Route::post('reset', [AuthenticationController::class, 'reset'])->name('reset');
        Route::post('set-password', [AuthenticationController::class, 'setPassword'])->name('set-password');
    });

    Route::middleware(setting('core.auth.middleware', 'auth:sanctum'))->group(function () {

        Route::name('auth.')->prefix('auth')->group(function () {
            Route::get('profile', [AuthenticationController::class, 'profile'])->name('profile');
            Route::patch('profile', [AuthenticationController::class, 'update'])->name('update');
            Route::post('change-password', [AuthenticationController::class, 'changePassword'])->name('change-password');
            Route::post('logout', [AuthenticationController::class, 'logout'])->name('logout');
        });

        Route::get('categories/{category}/tree', [CategoryController::class, 'tree'])->name('categories.tree');
        Route::get('categories/{category}/children', [CategoryController::class, 'children'])->name('categories.children');
        Route::apiResource('categories', CategoryController::class);

        Route::apiResource('banners', BannerController::class);

        Route::apiResource('widgets', WidgetController::class);
    });

});

