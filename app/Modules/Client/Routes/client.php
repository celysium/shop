<?php

use App\Modules\Client\Controllers\AuthenticationController;
use Illuminate\Support\Facades\Route;

Route::prefix('app')->name('app.')->group(function () {

    Route::name('auth.')->prefix('auth')->group(function () {
        Route::post('check', [AuthenticationController::class, 'check'])->name('check');
        Route::post('otp', [AuthenticationController::class, 'otp'])->name('otp');
        Route::post('login', [AuthenticationController::class, 'login'])->name('login');
        Route::post('forget', [AuthenticationController::class, 'forget'])->name('forget');
        Route::post('reset', [AuthenticationController::class, 'reset'])->name('reset');
        Route::post('set-password', [AuthenticationController::class, 'setPassword'])->name('set-password');
    });

    Route::middleware(setting('auth.middleware', 'auth:sanctum'))->group(function () {

        Route::name('auth.')->prefix('auth')->group(function () {
            Route::get('profile', [AuthenticationController::class, 'profile'])->name('profile');
            Route::patch('profile', [AuthenticationController::class, 'update'])->name('update');
            Route::post('change-password', [AuthenticationController::class, 'changePassword'])->name('change-password');
            Route::post('logout', [AuthenticationController::class, 'logout'])->name('logout');
        });
    });

});

