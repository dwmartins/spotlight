@extends('layouts.app')

@section('main-content')
    <div class="min-height-300 bg-primary w-100 position-absolute top-0 start-0 z-1"></div>

    <section class="position-relative z-1 container-fluid site-info-view">
        <form action="/app/settings/basic-info" method="post" class="card mb-3 custom-bg-white custom-text-dark rounded-3 border-0 shadow form-basic-info">
            @csrf
            <div class="card-body">
                <h5 class="card-title">{{ trans('messages.BASIC_INFO_SETTINGS_TITLE') }}</h5>

                <div class="row mt-4">
                    <div class="mb-3 col-md-4">
                        <label for="webSiteName" class="form-label">{{ trans('messages.LABEL_SITE_NAME') }}</label>
                        <input name="webSiteName" type="text" value="{{ old('webSiteName', $siteInfo->webSiteName ?? '') }}" class="form-control custom_focus text-secondary" id="webSiteName">
                    </div>
        
                    <div class="mb-3 col-md-4">
                        <label for="email" class="form-label">{{ trans('messages.LABEL_EMAIL') }}</label>
                        <input name="email" type="text" value="{{ old('email', $siteInfo->email ?? '') }}" class="form-control custom_focus text-secondary" id="email">
                    </div>
        
                    <div class="mb-3 col-md-4">
                        <label for="phone" class="form-label">{{ trans('messages.LABEL_PHONE') }}</label>
                        <input name="phone" type="number" value="{{ old('number', $siteInfo->number ?? '') }}" class="form-control custom_focus text-secondary" id="phone">
                    </div>
        
                    <div class="mb-3 col-md-4">
                        <label for="city" class="form-label">{{ trans('messages.LABEL_CITY') }}</label>
                        <input name="city" type="text" value="{{ old('city', $siteInfo->city ?? '') }}" class="form-control custom_focus text-secondary" id="city">
                    </div>
        
                    <div class="mb-3 col-md-4">
                        <label for="state" class="form-label">{{ trans('messages.LABEL_STATE') }}</label>
                        <input name="state" type="text" value="{{ old('state', $siteInfo->state ?? '') }}" class="form-control custom_focus text-secondary" id="state">
                    </div>
        
                    <div class="mb-3 col-md-4">
                        <label for="address" class="form-label">{{ trans('messages.LABEL_ADDRESS') }}</label>
                        <input name="address" type="text" value="{{ old('address', $siteInfo->address ?? '') }}" class="form-control custom_focus text-secondary" id="address">
                    </div>
        
                    <div class="mb-3 col-md-4">
                        <label for="instagram" class="form-label">{{ trans('messages.LABEL_INSTAGRAM') }}</label>
                        <input name="instagram" type="text" value="{{ old('instagram', $siteInfo->instagram ?? '') }}" class="form-control custom_focus text-secondary" id="instagram">
                    </div>
        
                    <div class="mb-3 col-md-4">
                        <label for="facebook" class="form-label">{{ trans('messages.LABEL_FACEBOOK') }}</label>
                        <input name="facebook" type="text" value="{{ old('facebook', $siteInfo->facebook ?? '') }}" class="form-control custom_focus text-secondary" id="facebook">
                    </div>
        
                    <div class="mb-3 col-md-4">
                        <label for="x" class="form-label">{{ trans('messages.LABEL_X') }} <span class="opacity-75 fs-8">({{ trans('messages.OLD_TWITTER') }})</span></label>
                        <input name="x" type="text" value="{{ old('x', $siteInfo->x ?? '') }}" class="form-control custom_focus text-secondary" id="x">
                    </div>
        
                    <div class="mb-3 col-md-6">
                        <label for="description" class="form-label">{{ trans('messages.LABEL_DESCRIPTION') }} <span class="opacity-75 fs-8">(SEO)</span></label>
                        <x-textarea 
                            id="description" 
                            name="description" 
                            :maxChars="500" 
                            placeholder="{{ trans('messages.PLACEHOLDER_DESCRIPTION') }}"
                            rows='4'
                            value="{{ old('description', $siteInfo->description ?? '') }}"
                        />
                    </div>
        
                    <div class="mb-3 col-md-6">
                        <label for="keywords" class="form-label">{{ trans('messages.LABEL_KEYWORDS') }} <span class="opacity-75 fs-8">(SEO)</span></label>
                        <select id="keywords" name="keywords[]" multiple>
                            @if (!empty($siteInfo->keywords))
                                @foreach ($siteInfo->keywords as $keyword)
                                    <option value="{{ trim($keyword) }}" selected>{{ trim($keyword) }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
        
                    <div class="d-flex justify-content-end">
                        <x-buttons.btn-primary-outline 
                            text="{{ trans('messages.BTN_TEXT_SAVE_CHANGES') }}" 
                            :use-loader="true"
                            onclick="toggleLoading(this, true, true)"
                            type="submit"
                        />  
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection