<?php

use App\Http\Controllers\App\WebsiteInfoController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;

/** 
 * Views
 */
Route::get('/app/settings/basic-info', [WebsiteInfoController::class, 'index'])
    ->middleware([IsAdmin::class])
    ->name('app_settings_basic_info');

/**
 * Methods
 */
Route::post('/app/settings/basic-info', [WebsiteInfoController::class, 'save'])
    ->middleware([IsAdmin::class]);

Route::post('/app/settings/update-images', [WebsiteInfoController::class, 'updateFiles'])
    ->middleware([IsAdmin::class]);