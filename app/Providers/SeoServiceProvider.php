<?php

namespace App\Providers;

use App\Models\WebsiteInfo;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class SeoServiceProvider extends ServiceProvider
{
    private $siteInfoCacheKey = 'site_info';

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
        if (App::runningInConsole()) {
            return;
        }

        $siteInfo = Cache::get($this->siteInfoCacheKey);

        if(!$siteInfo) {
            $siteInfo = WebsiteInfo::first();
            Cache::put($this->siteInfoCacheKey, $siteInfo, now()->addMinutes(config('constants.cache_time')));
        }

        if(Schema::hasTable('website_info')) {
            $seoData = $siteInfo;

            $defaultSeoData = [
                'title' => 'My listings site',
                'favicon' => "/assets/images/default/favicon.ico"
            ];

            $seo = [
                'title' => $seoData && $seoData->webSiteName ? $seoData->webSiteName : $defaultSeoData['title'],
                'description' => $seoData && $seoData->description ? $seoData->description : null,
                'keywords' => $seoData && $seoData->keywords ? $seoData->keywords : null,
                'favicon' => $seoData && $seoData->favicon ? "/storage/site/images/$seoData->favicon" : $defaultSeoData['favicon']
            ];

            view()->share('seo', $seo);
        }
    }
}
