<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function show(): View
    {
        $webSiteName = config('website_info.websiteName');

        return view('pages.auth.login', [
            'custom_seo_title' => trans('messages.SEO_TITLE_LOGIN') . ' | ' . $webSiteName
        ]);
    }
}
