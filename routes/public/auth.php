<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/**
 * Views
 */
Route::get(trans('messages.PUBLIC_PATH_LOGIN'), [AuthController::class, 'show'])->name('login');
Route::get(trans('messages.PUBLIC_PATH_REGISTER'), [AuthController::class, 'registerView'])->name('register');

/**
 * Methods
 */
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/register', [AuthController::class, 'register']);