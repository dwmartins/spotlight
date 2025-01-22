<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/**
 * Views
 */
Route::get(trans('messages.PUBLIC_PATH_LOGIN'), [AuthController::class, 'show'])->name('login');

/**
 * Methods
 */
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);