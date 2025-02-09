<?php

use App\Http\Controllers\App\SettingsController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;

/** 
 * Views
 */
Route::get('/app/settings/general', [SettingsController::class, 'showView'])
    ->middleware([IsAdmin::class])
    ->name('app_settings_general');

/**
 * Methods
 */
Route::post('/app/settings/general', [SettingsController::class, 'update'])
    ->middleware([IsAdmin::class]);