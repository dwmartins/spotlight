<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/**
 * Views
 */
Route::get(trans('messages.PUBLIC_PATH_USER_PANEL'), [UserController::class, 'panelView'])
    ->name('user_panel')
    ->middleware('auth');

Route::get(trans('messages.PUBLIC_PATH_USER_PROFILE'), [UserController::class, 'profileView'])
    ->name('user_profile')
    ->middleware('auth');

/**
 * Methods
 */
Route::post('/user/update-avatar', [UserController::class, 'updateAvatar'])
    ->middleware('auth');

Route::post('/user', [UserController::class, 'update'])
    ->middleware('auth');

Route::post('/user/change-password', [UserController::class, 'changePassword'])
    ->middleware('auth');