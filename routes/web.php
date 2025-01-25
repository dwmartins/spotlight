<?php

use Illuminate\Support\Facades\Route;

require base_path('routes/public/public.php');
require base_path('routes/public/auth.php');
require base_path('routes/public/user.php');

Route::prefix('app')->group(base_path('routes/app/app.php'));
