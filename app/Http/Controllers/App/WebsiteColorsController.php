<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\WebsiteColors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class WebsiteColorsController extends Controller
{
    private $websiteColors = 'website_colors';

    public function changeColors(Request $request)
    {
        $colors = $request->all();

        foreach ($colors as $name => $hexValue) {
            $color = WebsiteColors::where('name', $name)->first();

            if($color) {
                $color->update(['hex_value' => $hexValue]);
            } 
        }

        $colors = WebsiteColors::all();
        Cache::put($this->websiteColors, $colors, now()->addMinutes(config('constants.cache_time')));

        return redirectWithMessage('success', trans('messages.ALERT_TITLE_SUCCESS'), trans('messages.COLORS_UPDATED'), 'app_dashboard');
    }
}
