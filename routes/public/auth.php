<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/**
 * Views
 */
Route::get(trans('messages.PUBLIC_PATH_LOGIN'), [AuthController::class, 'show'])->name('login');
Route::get(trans('messages.PUBLIC_PATH_REGISTER'), [AuthController::class, 'registerView'])->name('register');
Route::get(trans('messages.PUBLIC_PATH_RESET_PASSWORD'), [AuthController::class, 'recoverPasswordView'])->name('recover_password');

/**
 * Methods
 */
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/register', [AuthController::class, 'register']);