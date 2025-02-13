<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get(trans('url.maintenance'), function() {
    return view('pages.maintenance');
})->name('maintenance');

Route::get('/', [HomeController::class, 'show'])->name('home_page');