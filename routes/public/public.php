<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'show']);

// Routes for authentication
Route::middleware(['web'])->group(function () {
    Route::get(trans('messages.PUBLIC_PATH_LOGIN'), [AuthController::class, 'show'])->name('public_login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});