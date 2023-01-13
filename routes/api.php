<?php

use App\Http\Controllers\Auth\RegisterCustomerController;
use Illuminate\Support\Facades\Route;


Route::name('api.')->group(function () {
    Route::name('auth.')->group(function () {
        Route::post('/register', RegisterCustomerController::class)->name('register');
    });
});
