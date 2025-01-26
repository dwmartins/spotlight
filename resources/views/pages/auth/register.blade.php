@extends('layouts.base')

@section('content')

    <section class="registerView container d-flex align-items-center show">
        <div class="row w-100 m-0">
            <div class="col-sm-12 col-md-5 col-xl-6 d-flex flex-column justify-content-center align-items-center">
                
                <form id="formRegister" action="/register" method="post" class="w-100 p-0 p-sm-3">
                    <div class="website_logo item_center mb-2">
                        <img src="{{ config('website_info.logoImage') }}" alt="Logo">
                    </div>
                    
                    <h4 class="text-secondary text-center">{{ trans('messages.TITLE_REGISTER') }}</h4>

                    @csrf

                    <div class="mb-3">
                        <label for="name" class="text-secondary mb-2"><span class="text-danger me-1">*</span>{{ trans('messages.LABEL_NAME') }}</label>
                        <input type="text" name="name" id="name" autocomplete="name" class="form-control custom_focus" value="{{ old('name')}}">
                    </div>

                    <div class="mb-3">
                        <label for="lastName" class="text-secondary mb-2"><span class="text-danger me-1">*</span>{{ trans('messages.LABEL_LAST_NAME') }}</label>
                        <input type="text" name="lastName" id="lastName" autocomplete="lastName" class="form-control custom_focus" value="{{ old('lastName')}}">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="text-secondary mb-2"><span class="text-danger me-1">*</span>{{ trans('messages.LABEL_EMAIL') }}</label>
                        <input type="email" name="email" id="email" autocomplete="email" class="form-control custom_focus" value="{{ old('email') }}">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="text-secondary mb-2"><span class="text-danger me-1">*</span>{{ trans('messages.LABEL_PASSWORD') }}</label>
                        <div class="position-relative">
                            <input type="password" name="password" id="password" class="form-control custom_focus">
                            <i class="fa-regular icon_show_password fa-eye text-secondary"></i>
                        </div>
                    </div>

                    <div class="fs-8 text-secondary text-center mb-3">
                        {{ trans('messages.ACCEPT_OUR_PRIVACY') }}
                        <a href="/" class="text-primary outline_none">{{ trans('messages.PRIVACY_PAGE') }}</a>
                    </div>

                    <button id="btnLogin" class="btn btn-primary w-100">
                        {{ trans('messages.BTN_TEXT_CREATE_ACCOUNT') }}
                    </button>

                    <hr class="text-secondary">

                    <p class="text-secondary text-center">
                        {{ trans('messages.HAVE_ACCOUNT') }}
                        <a href="{{ route('login') }}" class="text-primary outline_none">{{ trans('messages.NAV_NAME_LOGIN') }}</a>
                    </p>
                </form>
            </div>
            <div class="col-md-7 col-xl-6 d-none d-md-flex justify-content-center align-items-center">
                <img src="{{ asset('assets/svg/signUp.svg') }}" alt="Illustration" class="illustration">
            </div>
        </div>
    </section>

@vite('resources/js/auth/index.js')

@endsection