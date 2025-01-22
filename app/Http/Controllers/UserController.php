<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * returns the user panel view  /pages/user/panel.blade.php
     * @return View
     */
    public function panelView(): View {
        $websiteName = config('website_info.websiteName');

        return view('pages.user.panel', [
            'custom_seo_title' => trans('messages.SEO_TITLE_USER_PANEL') . ' | ' . $websiteName
        ]);
    }
}
