<?php

use App\Http\Controllers\App\WebsiteColorsController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;

/**
 * Methods
 */
Route::post('/app/custom/colors', [WebsiteColorsController::class, 'changeColors'])
    ->middleware([IsAdmin::class]);

