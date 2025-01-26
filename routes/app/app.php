<?php

use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;

Route::middleware([IsAdmin::class])->prefix('app')->group(function() {
    Route::get('/', function () {
        return view('pages.app.dashboard', ['page_name' => 'Dashboard']);
    });
});