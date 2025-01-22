<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/**
 * Views
 */
route::get(trans('messages.PUBLIC_PATH_USER_PANEL'), [UserController::class, 'panelView'])
    ->name('user_panel')
    ->middleware('auth');