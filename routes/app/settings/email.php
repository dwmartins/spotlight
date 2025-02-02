<?php

use App\Http\Controllers\App\EmailSettingsController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;

/** 
 * Views
 */
Route::get('/app/settings/email', [EmailSettingsController::class, 'showSettings'])
    ->middleware([IsAdmin::class])
    ->name('app_settings_email');

/**
 * Methods
 */
Route::post('/app/settings/email', [EmailSettingsController::class, 'save'])
    ->middleware([IsAdmin::class]);