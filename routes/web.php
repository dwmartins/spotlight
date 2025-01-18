<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/')->group(base_path('routes/public/public.php'));

Route::prefix('app')->group(base_path('routes/app/app.php'));
