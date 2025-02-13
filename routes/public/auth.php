<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/**
 * Views
 */
Route::get(trans('url.login'), [AuthController::class, 'show'])->name('login');
Route::get(trans('url.register'), [AuthController::class, 'registerView'])->name('register');
Route::get(trans('url.recover_password'), [AuthController::class, 'recoverPasswordView'])->name('recover_password');
Route::get(trans('url.reset_password') . '/{token}', [AuthController::class, 'resetPasswordView'])->name('reset_password');

Route::get('/app/login', [AuthController::class, 'AdminLoginView'])->name('admin_login');

/**
 * Methods
 */
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/recover-password', [AuthController::class, 'sendResetLinkEmail']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

Route::post('/app/login', [AuthController::class, 'AdminLogin']);