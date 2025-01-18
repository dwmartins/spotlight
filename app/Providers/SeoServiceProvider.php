<?php

namespace App\Providers;

use App\Models\WebsiteInfo;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class SeoServiceProvider extends ServiceProvider
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
        if(Schema::hasTable('website_info')) {
            $seoData = WebsiteInfo::first();

            $defaultSeoData = [
                'title' => 'My listings site',
                'icon' => "/assets/images/default/icon.ico"
            ];

            $seo = [
                'title' => $seoData && $seoData->webSiteName ? $seoData->webSiteName : $defaultSeoData['title'],
                'description' => $seoData && $seoData->description ? $seoData->description : null,
                'keywords' => $seoData && $seoData->keywords ? $seoData->keywords : null,
                'icon' => $seoData && $seoData->icon ? "/storage/site/$seoData->icon" : $defaultSeoData['icon']
            ];

            view()->share('seo', $seo);
        }
    }
}
