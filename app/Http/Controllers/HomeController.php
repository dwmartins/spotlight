<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function show(): View
    {
        $webSiteName = config('webSiteName');

        return view('pages.home', [
            'custom_seo_title' => "Página inicial | $webSiteName"
        ]);
    }
}
