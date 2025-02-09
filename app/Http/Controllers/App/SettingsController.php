<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingsController extends Controller
{
    private $settingCacheKey = 'settings_all';

    /**
     * Return view general settings pages/app/settings/general.blade.php
     * @return View
     */
    public function showView(): View
    {
        $settings = $this->getSettings();

        return view('pages.app.settings.general', [
            'page_name' => trans('messages.APP_PAGE_GENERAL_SETTINGS'),
            'settings' => $settings
        ]);
    }

    public function update(Request $request) 
    {
        $settings = $request->all();
        $isCheckBox = false;
        $field = null;

        if(isset($settings['type']) && $settings['type'] == 'checkbox') {
            $isCheckBox = true;
        }

        if(isset($settings['field'])) {
            $field = $settings['field'];
        }

        if($isCheckBox) {
            $value = $request->has($field) ? 'on' : 'off';

            $setting = Settings::where('name', $field)->first();

            if($setting) {
                $setting->update([
                    'value' => $value
                ]);
            }

            $this->updateSettingsCache();
            return redirectWithMessage('success', trans('messages.ALERT_TITLE_SUCCESS'), trans('messages.CHANGES_UPDATED_SUCCESSFULLY'), 'app_settings_general');
        }
    }

    /**
     * @return Array
     */
    public function getSettings()
    {
        $settings = Cache::get($this->settingCacheKey);

        if(!$settings) {
            $settings = Settings::pluck('value', 'name')->toArray();
            Cache::put($this->settingCacheKey, $settings, now()->addMinutes(config('constants.cache_time')));
        }

        return $settings;
    }

    private function updateSettingsCache()
    {
        $settings = Settings::pluck('value', 'name')->toArray();
        Cache::put($this->settingCacheKey, $settings, now()->addMinutes(config('constants.cache_time')));
    }
}
