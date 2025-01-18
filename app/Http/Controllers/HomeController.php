<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HomeController extends Controller
{
    public function show(): View
    {
        $webSiteName = config('website_info.websiteName');

        return view('pages.home', [
            'custom_seo_title' => "Página inicial | $webSiteName"
        ]);
    }
}
