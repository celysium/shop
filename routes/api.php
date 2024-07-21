<?php

use App\Http\Controllers\Admin\AuthenticateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {

    Route::prefix('auth')->name('auth.')->group(function () {
        Route::post('login', [AuthenticateController::class,'login'])->name('login');
    });
});

Route::prefix('admin')->name('admin.')->middleware('auth:sanctum')->group(function () {

    Route::prefix('auth')->name('auth.')->group(function () {

        Route::post('logout', [AuthenticateController::class,'logout'])->name('logout');
    });
});

