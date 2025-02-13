@extends('layouts.app')

@section('main-content')
    <div class="min-height-300 bg-primary w-100 position-absolute top-0 start-0 z-1"></div>

    <section class="position-relative z-1 container-fluid site-info-view">
        <form action="/app/settings/update-images" method="post" enctype="multipart/form-data" class="card mb-4 custom-bg-white custom-text-dark rounded-3 border-0 shadow form-update-images">
            @csrf
            <div class="card-body">
                <h5 class="card-title">{{ trans('messages.visual_identity_settings_title') }}</h5>

                <!-- Logo Image -->
                <div class="row mt-4">
                    <div class="col-sm-12 col-lg-4 item_center mb-4">
                        <img src="{{ config('website_info.logoImage') }}" id="current_logoImage" alt="Logo" class="previewImg">
                        <div class="loading_logoImage d-none">
                            <x-loader 
                                color="primary"
                                size="lg"
                            />
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-8">
                        <h6>{{ trans('messages.choose_your_logo_image') }}</h6>
                        <p>{{ trans('messages.format_logo_image') }}</p>

                        <div id="logoImage_selected" class="d-none d-flex justify-content-between align-items-center gap-2 mt-4">
                            <p class="text-secondary m-0 fileName"></p>
                            <button type="button" class="btn btn-sm btn-danger" id="cancel-LogoImage">{{ trans('messages.btn_text_cancel') }}</button>
                        </div>

                        <div id="upload_logoImage" class="d-flex justify-content-center justify-content-lg-start mt-4">
                            <label for="logoImage" class="btn btn-sm btn-primary">
                                {{ trans('messages.select_file') }}<i class="fa-regular fa-file-image ms-1"></i>
                                <input type="file" id="logoImage" name="logoImage" class="d-none" accept="{{ config('constants.accepted_image') }}">
                            </label>
                        </div>
                    </div>
                </div>

                <hr class="text-secondary my-5">

                <!-- Cover Image -->
                <div class="row">
                    <div class="col-sm-12 col-lg-4 mb-4 item_center">
                        <img src="{{ config('website_info.coverImage') }}" id="current_coverImage" alt="Cover image" class="previewImg">
                        <div class="loading_coverImage d-none">
                            <x-loader 
                                color="primary"
                                size="lg"
                            />
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-8">
                        <h6>{{ trans('messages.choose_your_cover_image') }}</h6>
                        <p>{{ trans('messages.format_image') }}</p>

                        <div id="coverImage_selected" class="d-none d-flex justify-content-between align-items-center gap-2 mt-4">
                            <p class="text-secondary m-0 fileName"></p>
                            <button type="button" class="btn btn-sm btn-danger" id="cancel_coverImage">{{ trans('messages.btn_text_cancel') }}</button>
                        </div>
                        
                        <div id="upload_coverImage" class="d-flex justify-content-center justify-content-lg-start mt-4">
                            <label for="coverImage" class="btn btn-sm btn-primary">
                                {{ trans('messages.select_file') }}<i class="fa-regular fa-file-image ms-1"></i>
                                <input type="file" id="coverImage" name="coverImage" class="d-none" accept="{{ config('constants.accepted_image') }}">
                            </label>
                        </div>
                    </div>
                </div>

                <hr class="text-secondary my-5">

                <!-- favicon -->
                <div class="row">
                    <div class="col-sm-12 col-lg-4 mb-4 item_center">
                        <img src="{{ config('website_info.favicon') }}" id="current_favicon" alt="Favicon" class="previewFavicon">
                        <div class="loading_favicon d-none">
                            <x-loader 
                                color="primary"
                                size="lg"
                            />
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-8">
                        <h6>{{ trans('messages.choose_your_favicon') }}</h6>
                        <p>{{ trans('messages.format_favicon') }}</p>

                        <div id="favicon_selected" class="d-none d-flex justify-content-between align-items-center gap-2 mt-4">
                            <p class="text-secondary m-0 fileName" id="fileName"></p>
                            <button type="button" class="btn btn-sm btn-danger" id="cancel_favicon">{{ trans('messages.btn_text_cancel') }}</button>
                        </div>
                        
                        <div id="upload_favicon" class="d-flex justify-content-center justify-content-lg-start mt-4">
                            <label for="favicon" class="btn btn-sm btn-primary">
                                {{ trans('messages.select_file') }}<i class="fa-regular fa-file-image ms-1"></i>
                                <input type="file" id="favicon" name="favicon" class="d-none" accept="{{ config('constants.accepted_favicon') }}">
                            </label>
                        </div>
                    </div>
                </div>

                <hr class="text-secondary my-5">

                <!-- Default image -->
                <div class="row">
                    <div class="col-sm-12 col-lg-4 mb-4 item_center">
                        <img src="{{ config('website_info.defaultImage') }}" id="current_defaultImage" alt="Default image" class="previewImg">
                        <div class="loading_defaultImage d-none">
                            <x-loader 
                                color="primary"
                                size="lg"
                            />
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-8">
                        <h6>{{ trans('messages.chose_your_default_image') }}</h6>
                        <p class="mb-0">{{ trans('messages.format_image') }}</p>
                        <p class="fs-8">{{ trans('messages.default_image_message') }}</p>
    
                        <div id="defaultImage_selected" class="d-none d-flex justify-content-between align-items-center gap-2 mt-4">
                            <p class="text-secondary m-0 fileName" id="fileName"></p>
                            <button type="button" class="btn btn-sm btn-danger" id="cancelDefaultImg">{{ trans('messages.btn_text_cancel') }}</button>
                        </div>
                        
                        <div id="upload_defaultImage" class="d-flex justify-content-center justify-content-lg-start mt-4">
                            <label for="defaultImage" class="btn btn-sm btn-primary">
                                {{ trans('messages.select_file') }}<i class="fa-regular fa-file-image ms-1"></i>
                                <input type="file" id="defaultImage" name="defaultImage" class="d-none" accept="{{ config('constants.accepted_image') }}">
                            </label>
                        </div>
                    </div>
                </div>

                <hr class="text-secondary my-5">

                <div class="d-flex justify-content-end">
                    <x-buttons.btn-primary-outline 
                        text="{{ trans('messages.btn_text_save_changes') }}" 
                        :use-loader="true"
                        id="btn_save_files"
                        type="submit"
                    /> 
                </div>
            </div>
        </form>

        <form action="/app/settings/basic-info" method="post" class="card mb-3 custom-bg-white custom-text-dark rounded-3 border-0 shadow form-basic-info">
            @csrf
            <div class="card-body">
                <h5 class="card-title">{{ trans('messages.basic_info_settings_title') }}</h5>

                <div class="row mt-4">
                    <div class="mb-3 col-md-4">
                        <label for="webSiteName" class="form-label">{{ trans('form.label_site_name') }}</label>
                        <input name="webSiteName" type="text" value="{{ old('webSiteName', $siteInfo->webSiteName ?? '') }}" class="form-control custom_focus text-secondary" id="webSiteName">
                    </div>
        
                    <div class="mb-3 col-md-4">
                        <label for="email" class="form-label">{{ trans('form.label_email') }}</label>
                        <input name="email" type="text" value="{{ old('email', $siteInfo->email ?? '') }}" class="form-control custom_focus text-secondary" id="email">
                    </div>
        
                    <div class="mb-3 col-md-4">
                        <label for="phone" class="form-label">{{ trans('form.label_phone') }}</label>
                        <input name="phone" type="number" value="{{ old('number', $siteInfo->number ?? '') }}" class="form-control custom_focus text-secondary" id="phone">
                    </div>
        
                    <div class="mb-3 col-md-4">
                        <label for="city" class="form-label">{{ trans('form.label_city') }}</label>
                        <input name="city" type="text" value="{{ old('city', $siteInfo->city ?? '') }}" class="form-control custom_focus text-secondary" id="city">
                    </div>
        
                    <div class="mb-3 col-md-4">
                        <label for="state" class="form-label">{{ trans('form.label_state') }}</label>
                        <input name="state" type="text" value="{{ old('state', $siteInfo->state ?? '') }}" class="form-control custom_focus text-secondary" id="state">
                    </div>
        
                    <div class="mb-3 col-md-4">
                        <label for="address" class="form-label">{{ trans('form.label_address') }}</label>
                        <input name="address" type="text" value="{{ old('address', $siteInfo->address ?? '') }}" class="form-control custom_focus text-secondary" id="address">
                    </div>
        
                    <div class="mb-3 col-md-4">
                        <label for="instagram" class="form-label">{{ trans('form.label_instagram') }}</label>
                        <input name="instagram" type="text" value="{{ old('instagram', $siteInfo->instagram ?? '') }}" class="form-control custom_focus text-secondary" id="instagram">
                    </div>
        
                    <div class="mb-3 col-md-4">
                        <label for="facebook" class="form-label">{{ trans('form.label_facebook') }}</label>
                        <input name="facebook" type="text" value="{{ old('facebook', $siteInfo->facebook ?? '') }}" class="form-control custom_focus text-secondary" id="facebook">
                    </div>
        
                    <div class="mb-3 col-md-4">
                        <label for="x" class="form-label">{{ trans('form.label_x') }} <span class="opacity-75 fs-8">({{ trans('messages.old_twitter') }})</span></label>
                        <input name="x" type="text" value="{{ old('x', $siteInfo->x ?? '') }}" class="form-control custom_focus text-secondary" id="x">
                    </div>
        
                    <div class="mb-3 col-md-6">
                        <label for="description" class="form-label">{{ trans('form.label_description') }} <span class="opacity-75 fs-8">(SEO)</span></label>
                        <x-textarea 
                            id="description" 
                            name="description" 
                            :maxChars="500" 
                            placeholder="{{ trans('messages.placeholder_description') }}"
                            rows='4'
                            value="{{ old('description', $siteInfo->description ?? '') }}"
                        />
                    </div>
        
                    <div class="mb-3 col-md-6">
                        <label for="keywords" class="form-label">{{ trans('form.label_keywords') }} <span class="opacity-75 fs-8">(SEO)</span></label>
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
                            text="{{ trans('messages.btn_text_save_changes') }}" 
                            :use-loader="true"
                            onclick="toggleLoading(this, true, true)"
                            type="submit"
                        />  
                    </div>
                </div>
            </div>
        </form>
    </section>

    @vite('resources/js/dashboard/settings/basicInfo.js')
@endsection