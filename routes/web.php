<?php

use Illuminate\Support\Facades\Route;

Route::middleware([\App\Http\Middleware\CheckForMaintenance::class])->group(function () {
    require base_path('routes/public/public.php');
    require base_path('routes/public/auth.php');
    require base_path('routes/public/user.php');
});

// App
require base_path('routes/app/app.php');
require base_path('routes/app/custom/colors.php');
require base_path('routes/app/settings/email.php');
require base_path('routes/app/settings/basic-info.php');
require base_path('routes/app/settings/general.php');

