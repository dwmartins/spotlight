<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/')->group(base_path('routes/public/public.php'));

Route::prefix('/')->group(base_path('routes/public/auth.php'));

Route::prefix(trans('messages.PATH_PREFIX_USER'))->group(base_path('routes/public/user.php'));

Route::prefix('app')->group(base_path('routes/app/app.php'));
