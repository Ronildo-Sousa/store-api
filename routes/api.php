<?php

use App\Http\Controllers\Auth\LoginCustomerController;
use App\Http\Controllers\Auth\RegisterAdminController;
use App\Http\Controllers\Auth\RegisterCustomerController;
use Illuminate\Support\Facades\Route;

Route::name('api.')->group(function () {
    Route::name('auth.')->group(function () {
        Route::post('/register', RegisterCustomerController::class)->name('register');
        Route::name('register-admin')
            ->post('/register/admin', RegisterAdminController::class)
            ->middleware('auth:sanctum');
        Route::post('/login', LoginCustomerController::class)->name('login');
    });
});
