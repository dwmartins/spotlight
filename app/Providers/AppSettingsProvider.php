<?php

namespace App\Providers;

use App\Models\Settings;
use App\Models\WebsiteColors;
use App\Models\WebsiteInfo;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppSettingsProvider extends ServiceProvider
{
    private $settingCacheKey = 'settings_all';
    private $siteInfoCacheKey = 'site_info';
    private $websiteColors = 'website_colors';
    
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

        $this->handle();
    }

    public function handle() {
        // Fetch the bank settings
        $settings = Cache::get($this->settingCacheKey);

        if(!$settings) {
            $settings = Settings::pluck('value', 'name')->toArray();
            Cache::put($this->settingCacheKey, $settings, now()->addMinutes(config('constants.cache_time')));
        }

        Config::set('website_settings', $settings);

        // Set the language (if found in the database, otherwise 'pt-BR')
        $this->setLocale($settings);

        // Set the timezone (if found in the database, otherwise 'America/Sao_Paulo')
        $this->setTimezone($settings);

        // Set default date (if found in database)
        $this->setDateFormat($settings);

        // set website infos
        $this->setWebsiteInfo();

        // Set website colors
        $this->setWebsiteColors();
    }

    private function setLocale($settings) {
        $locale = $settings['language'] ?? 'pt-BR';
        App::setLocale($locale);

        $translationsDir  = base_path('lang/' . $locale);
        
        // Check if the translations folder for the language exists
        if (!File::isDirectory($translationsDir)) {
            $errorMessage = "Translation directory  for language {$locale} not found at $translationsDir";
            Log::error($errorMessage);
            throw new \Exception($errorMessage);
        }
    }

    private function setTimezone($settings) {
        $timezone = $settings['timezone'] ?? 'America/Sao_Paulo';
        Config::set('app.timezone', $timezone);

        date_default_timezone_set($timezone);
    }

    private function setDateFormat($settings) {
        $dateFormat = $settings['date_format'] ?? 'DD-MM-YYYY';
        Config::set('app.date_format', $dateFormat);
    }

    private function setWebsiteInfo() {
        $siteInfo = Cache::get($this->siteInfoCacheKey);

        if(!$siteInfo) {
            $siteInfo = WebsiteInfo::first();
            Cache::put($this->siteInfoCacheKey, $siteInfo, now()->addMinutes(config('constants.cache_time')));
        }

        $defaultPath = "/assets/images/default";
        $imagesPath = "/storage/site/images";

        $websiteData = [
            'websiteName' => $siteInfo ? $siteInfo->webSiteName : "My listings site",
            'email' => $siteInfo ? $siteInfo->email : null,
            'phone' => $siteInfo ? $siteInfo->phone : null,
            'city' => $siteInfo ? $siteInfo->city : null,
            'state' => $siteInfo ? $siteInfo->state : null,
            'address' => $siteInfo ? $siteInfo->address : null,
            'instagram' => $siteInfo ? $siteInfo->instagram : null,
            'facebook' => $siteInfo ? $siteInfo->facebook : null,
            'x' => $siteInfo ? $siteInfo->x : null,
            'description' => $siteInfo ? $siteInfo->description : null,
            'keywords' => $siteInfo ? $siteInfo->keywords : null,
            'favicon' => $siteInfo && $siteInfo->favicon ? "$imagesPath/$siteInfo->favicon" : "$defaultPath/favicon.ico",
            'logoImage' => $siteInfo && $siteInfo->logoImage ? "$imagesPath/$siteInfo->logoImage" : "$defaultPath/logo.png",
            'coverImage' => $siteInfo && $siteInfo->coverImage ? "$imagesPath/$siteInfo->coverImage" : "$defaultPath/coverImage.jpg",
            'defaultImage' => $siteInfo && $siteInfo->defaultImage ? "$imagesPath/$siteInfo->defaultImage" : "$defaultPath/defaultImg.png",
        ];

        Config::set('website_info', $websiteData);
    }

    public function setWebsiteColors() {
        $colors = Cache::get($this->websiteColors);

        if(!$colors) {
            $colors = WebsiteColors::all();
            Cache::put($this->websiteColors, $colors, now()->addMinutes(config('constants.cache_time')));
        }

        foreach ($colors as $color) {
            Config::set('website_colors.' . $color->name, $color->hex_value);
        }
    }
}
