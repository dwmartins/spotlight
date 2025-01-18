<?php

namespace App\Providers;

use App\Models\WebsiteInfo;
use Illuminate\Support\ServiceProvider;

class SiteInfoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
       // 
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $siteInfo = WebsiteInfo::first();

        $defaultPath = "/assets/images/default";

        view()->share('website_websiteName', $siteInfo ? $siteInfo->webSiteName : null);
        view()->share('website_email', $siteInfo ? $siteInfo->email : null);
        view()->share('website_phone', $siteInfo ? $siteInfo->phone : null);
        view()->share('website_city', $siteInfo ? $siteInfo->city : null);
        view()->share('website_state', $siteInfo ? $siteInfo->state : null);
        view()->share('website_address', $siteInfo ? $siteInfo->address : null);
        view()->share('website_instagram', $siteInfo ? $siteInfo->instagram : null);
        view()->share('website_facebook', $siteInfo ? $siteInfo->facebook : null);
        view()->share('website_x', $siteInfo ? $siteInfo->x : null);
        view()->share('website_description', $siteInfo ? $siteInfo->description : null);
        view()->share('website_keywords', $siteInfo ? $siteInfo->keywords : null);

        view()->share('website_icon', $siteInfo && $siteInfo->icon ? $siteInfo->icon : "$defaultPath/icon.ico");
        view()->share('website_logoImage', $siteInfo && $siteInfo->logoImage ? $siteInfo->logoImage : "$defaultPath/logo.png");
        view()->share('website_coverImage', $siteInfo && $siteInfo->coverImage ? $siteInfo->coverImage : "$defaultPath/coverImage.jpg");
        view()->share('website_defaultImage', $siteInfo && $siteInfo->defaultImage ? $siteInfo->defaultImage : "$defaultPath/defaultImg.png");
    }
}
