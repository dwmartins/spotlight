<?php

namespace App\Providers;

use App\Models\Settings;
use App\Models\WebsiteInfo;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppSettingsProvider extends ServiceProvider
{
    private $cacheKey = 'settings_all';
    
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
        $this->handle();
    }

    public function handle() {
        // Fetch the bank settings
        $settings = Cache::get($this->cacheKey);

        if(!$settings) {
            $settings = Settings::pluck('value', 'name')->toArray();
            Cache::put('settings_all', $settings, now()->addMinutes(config('constants.cache_time')));
        }

        // Set the language (if found in the database, otherwise 'pt-BR')
        $this->setLocale($settings);

        // Set the timezone (if found in the database, otherwise 'America/Sao_Paulo')
        $this->setTimezone($settings);

        // Set default date (if found in database)
        $this->setDateFormat($settings);

        // set website infos
        $this->setWebsiteInfo();
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

        // Check if the main translation file exists
        $translationsPath = $translationsDir . '/messages.php';
        if (!File::exists($translationsPath)) {
            $errorMessage = "Translation file for language {$locale} not found at {$translationsPath}";
            Log::error($errorMessage);
            throw new \Exception($errorMessage);
        }


        // Check and load additional translation files if needed
        // Example: Checking extra files like "errors.php", "validation.php", etc.
        $additionalFiles = config('constants.translation_files', []);

        if(!empty($additionalFiles)) {
            foreach ($additionalFiles as $file) {
                $filePath = $translationsDir . '/' . $file;
                if (!File::exists($filePath)) {
                    Log::warning("Optional translation file {$file} not found at {$filePath}");
                }
            }
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
        $siteInfo = WebsiteInfo::first();

        $defaultPath = "/assets/images/default";
        $imagesPath = "/storage/site/";

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
            'icon' => $siteInfo && $siteInfo->icon ? "$imagesPath/$siteInfo->icon" : "$defaultPath/icon.ico",
            'logoImage' => $siteInfo && $siteInfo->logoImage ? "$imagesPath/$siteInfo->logoImage" : "$defaultPath/logo.png",
            'coverImage' => $siteInfo && $siteInfo->coverImage ? "$imagesPath/$siteInfo->coverImage" : "$defaultPath/coverImage.jpg",
            'defaultImage' => $siteInfo && $siteInfo->defaultImage ? "$imagesPath/$siteInfo->defaultImage" : "$defaultPath/defaultImg.png",
        ];

        Config::set('website_info', $websiteData);
    }
}
