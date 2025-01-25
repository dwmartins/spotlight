@extends('layouts.public')

@section('main-content')
<section class="profileView container-fluid">
    <div class="container my-2 my-sm-5">
        <h2 class="custom_dark fw-bolder">{{ trans('messages.PERSONAL_INFO') }}</h2>
        <p class="text-secondary m-0">{{ trans('messages.MANAGE_PERSONAL_HERE') }}</p>

        <div class="row mt-sm-3">
            <div class="col-12 col-lg-7 col-xxl-6">
                @include('forms.user.changeAvatar')

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <p class="fs-5 custom_dark mb-0">{{ trans('messages.BASIC_INFO') }}</p>
                    <button class="btn link-primary fs-7 fw-semibold letter-spacing text-uppercase p-0" data-toggle="basic_info_form">{{ trans('messages.UPDATE_USER_PROFILE') }}</button>
                </div>

                <div class="basic_info">
                    <!-- form basic info -->
                    <p class="text-secondary fs-7 mb-0">
                        <i class="fa-regular fa-address-card me-2"></i>
                        {{ auth()->user()->getFullName() }}
                    </p>

                    @if(auth()->user()->dateOfBirth)
                        <p class="text-secondary fs-7 mb-0">
                            <i class="fa-solid fa-cake-candles me-2"></i>
                            {{ getSimpleDate(auth()->user()->dateOfBirth) }}
                        </p>
                    @endif

                    <p class="text-secondary fs-7 mb-0">
                        <i class="fa-regular fa-envelope me-2"></i>
                        {{ auth()->user()->email }}
                    </p>

                    @if(auth()->user()->phone)
                        <p class="text-secondary fs-7 mb-0">
                            <i class="fa-solid fa-phone me-2"></i>
                            {{ auth()->user()->phone }}
                        </p>
                    @endif

                    <div id="basic_info_form" class="my-4" style="display: none">
                        @include('forms.user.basicInfo')
                    </div>

                    <hr class="text-secondary">
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <p class="fs-5 custom_dark mb-0">{{ trans('messages.USER_PROFILE_ADDRESS') }}</p>
                    <button class="btn link-primary fs-7 fw-semibold letter-spacing text-uppercase p-0" data-toggle="address_form">{{ trans('messages.UPDATE_USER_PROFILE') }}</button>
                </div>

                <div class="address">
                    <!-- form address -->
                    @if(auth()->user()->address)
                        <p class="text-secondary fs-7 mb-0">
                            <i class="fa-solid fa-location-dot me-2"></i>
                            {{ auth()->user()->address }}
                        </p>
                        <p class="text-secondary fs-7 mb-0">
                            @if(auth()->user()->city)
                                {{ auth()->user()->city }}
                            @endif

                            @if(auth()->user()->state)
                                {{ auth()->user()->city ? ', ' : '' }} {{ auth()->user()->state }}
                            @endif

                            @if(auth()->user()->zipCode)
                            {{ auth()->user()->city || auth()->user()->state ? ', ' : '' }} {{ auth()->user()->zipCode }}
                            @endif
                        </p>
                    @endif

                    <div id="address_form" class="my-4" style="display: none">
                        @include('forms.user.address')
                    </div>

                    <hr class="text-secondary">
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <p class="fs-5 custom_dark mb-0">{{ trans('messages.USER_PROFILE_PASSWORD') }}</p>
                    <button class="btn link-primary fs-7 fw-semibold letter-spacing text-uppercase p-0" data-toggle="password_form">{{ trans('messages.UPDATE_USER_PROFILE') }}</button>
                </div>

                <div>
                    <!-- form password -->
                    <div id="password_form" class="my-4" style="display: none">
                        @include('forms.user.password')
                    </div>

                    <hr class="text-secondary">
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <p class="fs-5 custom_dark mb-0">{{ trans('messages.USER_PROFILE_SETTINGS') }}</p>
                    <button class="btn link-primary fs-7 fw-semibold letter-spacing text-uppercase p-0" data-toggle="settings_form">{{ trans('messages.UPDATE_USER_PROFILE') }}</button>
                </div>

                <div>
                    <!-- form settings -->
                    <div id="settings_form" class="my-4" style="display: none">
                        @include('forms.user.settings')
                    </div>

                    <hr class="text-secondary">
                </div>

            </div>

            <div class="col-12 col-lg-5 col-xxl-6 p-3 pt-0 d-none d-lg-flex justify-content-end align-items-baseline">
                <img src="{{ asset('assets/svg/account.svg') }}" alt="Account" class="w-100">
            </div>
        </div>
    </div>
</section>

@vite('resources/js/user/profile.js')
@endsection