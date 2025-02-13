<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\WebsiteInfo;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class WebsiteInfoController extends Controller
{
    private $siteInfoCacheKey = 'site_info';
    private $pathToSiteImages = 'site/images';

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
            return redirectWithMessage('error', trans('messages.invalid_fields_message'), $errors);
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

            return redirectWithMessage('error', trans('messages.invalid_fields_message'), $errors);
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

        return redirectWithMessage('success', trans('messages.alert_title_success'), trans('messages.saved_website_information'), 'app_settings_basic_info');
    }

    public function updateFiles(Request $request) {
        $files = $request->allFiles();
        $websiteInfo = $this->getWebsiteInfo();

        if(!$websiteInfo) {
            $websiteInfo = new WebsiteInfo();
        }
        
        if(!$files) {
            return redirectWithMessage('error', '', trans('messages.no_file_sent'));
        }

        $allowedMimeTypes = config('constants.allowedMimeTypes.images');
        $maxSize = config('constants.allowedFileSizes.images');
        $errors = [];

        foreach ($files as $fieldName => $file) {
            $fileAttribute = trans('helper.file_atributes.' . $fieldName);

            if(!in_array($file->getMimeType(), $allowedMimeTypes)) {
                $errors[$fieldName] = [
                    trans('messages.specify_file_type', [
                        'attribute' => $fileAttribute,
                        'types' => 'jpeg, png, jpg'
                    ])
                ];
            }

            if($file->getSize() > $maxSize) {
                $errors[$fieldName] = [
                    trans('messages.specify_file_size', [
                        'attribute' => $fileAttribute,
                        'size' => '5'
                    ])
                ];
            }

            if($websiteInfo->{$fieldName}) {
                if(Storage::disk('public')->exists($this->pathToSiteImages . '/' . $websiteInfo->{$fieldName})) {
                    Storage::disk('public')->delete($this->pathToSiteImages . '/' . $websiteInfo->{$fieldName});
                }
            }

            $image = $request->file($fieldName);
            $imageName = $fieldName . '.' . $image->getClientOriginalExtension();

            $image->storeAs($this->pathToSiteImages, $imageName, 'public');

            $websiteInfo->{$fieldName} = $imageName;
        }

        if($websiteInfo->id) {
            $websiteInfo->save();
        } else {
            $websiteInfo::create();
        }

        Cache::put($this->siteInfoCacheKey, $websiteInfo, now()->addMinutes(config('constants.cache_time')));

        return redirectWithMessage('success', trans('messages.alert_title_success'), trans('messages.saved_website_images'), 'app_settings_basic_info'); 
    }

    private function getWebsiteInfo(): WebsiteInfo {
        $websiteInfo = Cache::get($this->siteInfoCacheKey);

        if(!$websiteInfo) {
            $websiteInfo = WebsiteInfo::first();
            Cache::put($this->siteInfoCacheKey, $websiteInfo, now()->addMinutes(config('constants.cache_time')));
        }

        return $websiteInfo;
    }
}
