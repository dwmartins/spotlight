<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\EmailSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class EmailSettingsController extends Controller
{
    private $emailSettingCacheKey = 'email_setting';

    public function showSettings(): View
    {
        return view('pages.app.settings.email', [
            'page_name' => trans('messages.APP_PAGE_EMAIL_SETTINGS'),
            'emailSettings' => EmailSetting::first()
        ]);
    }

    public function save(Request $request) {
        $errors = validateFields($request->all());
        if($errors) {
            return redirectWithMessage('error', trans('messages.invalid_fields_message'), $errors);
        }

        $validator = Validator::make($request->all(), [
            'host' => 'required|string|max:255',
            'port' => 'required|integer',
            'encryption' => 'required|in:SSL,TLS',
            'from_address' => 'required|email|max:255',
            'username' => 'required|string|max:255'
        ]);

        if($validator->fails()) {
            $errors = $validator->errors();

            return redirectWithMessage('error', trans('messages.invalid_fields_message'), $errors);
        }

        $emailSetting = EmailSetting::first();

        if($emailSetting) {
            $emailSetting->update($request->all());
        } else {
            $emailSetting = EmailSetting::create($request->all());
        }

        if(!empty($request->password)) {
            $emailSetting->password = $request->password;
            $emailSetting->save();
        }

        Cache::put($this->emailSettingCacheKey, $emailSetting, now()->addMinutes(config('constants.cache_time')));

        return redirectWithMessage('success', trans('messages.alert_title_success'), trans('messages.email_settings_updated'), 'app_settings_email');
    }

    public function getEmailSettings(): ?EmailSetting
    {
        $emailSetting = Cache::get($this->emailSettingCacheKey);

        if(!$emailSetting) {
            $emailSetting = EmailSetting::first();
            Cache::put($this->emailSettingCacheKey, $emailSetting, now()->addMinutes(config('constants.cache_time')));
        }

        if($emailSetting) {
            return $emailSetting;
        }

        Log::warning('Email settings not found');
        return null;
    }
}
