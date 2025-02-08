<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\WebsiteInfo;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class WebsiteInfoController extends Controller
{
    private $siteInfoCacheKey = 'site_info';

    public function index(): View
    {
        $siteInfo = Cache::get($this->siteInfoCacheKey);

        if(!$siteInfo) {
            $siteInfo = WebsiteInfo::first();
            Cache::put($this->siteInfoCacheKey, $siteInfo, now()->addMinutes(config('constants.cache_time')));
        }

        if($siteInfo) {
            $siteInfo->keywords = json_decode($siteInfo->keywords);
        }

        return view('pages.app.settings.site-info', [
            'page_name' => trans('messages.APP_PAGE_SITE_INFO'),
            'siteInfo' => $siteInfo
        ]);
    }

    public function save(Request $request) {
        $errors = validateFields($request->all());
        if($errors) {
            return redirectWithMessage('error', trans('messages.INVALID_FIELDS_MESSAGE'), $errors);
        }

        $validator = Validator::make($request->all(), [
            'webSiteName'  => 'nullable|string|max:255',
            'email'        => 'nullable|email|max:100',
            'phone'        => 'nullable|string|max:100',
            'city'         => 'nullable|string|max:100',
            'state'        => 'nullable|string|max:100',
            'address'      => 'nullable|string|max:255',
            'instagram'    => 'nullable|url|max:255',
            'facebook'     => 'nullable|url|max:255',
            'x'            => 'nullable|url|max:255',
            'description'  => 'nullable|string'
        ]);

        if($validator->fails()) {
            $errors = $validator->errors();

            return redirectWithMessage('error', trans('messages.INVALID_FIELDS_MESSAGE'), $errors);
        }

        $siteInfo = Cache::get($this->siteInfoCacheKey);

        if(!$siteInfo) {
            $siteInfo = WebsiteInfo::first();
            Cache::put($this->siteInfoCacheKey, $siteInfo, now()->addMinutes(config('constants.cache_time')));
        }

        $data = $request->all();

        if(isset($data['keywords'])) {
            $data['keywords'] = json_encode($data['keywords']);
        } else {
            $data['keywords'] = '';
        }

        if($siteInfo) {
            $siteInfo->update($data);
        } else {
            $siteInfo = WebsiteInfo::create($data);
        }

        Cache::put($this->siteInfoCacheKey, $siteInfo, now()->addMinutes(config('constants.cache_time')));

        return redirectWithMessage('success', trans('messages.ALERT_TITLE_SUCCESS'), trans('messages.SAVED_WEBSITE_INFORMATION'), 'app_settings_basic_info');
    }
}
