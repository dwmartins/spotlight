@extends('layouts.base')

@section('content')
    <section class="publicLoginView container item_center vh-100">
        <div class="row w-100">
            <div class="col-sm-12 col-md-6 col-xl-6 d-flex justify-content-center align-items-center" data-aos="fade-right">
                <form action="/login" method="post" class="form_login w-100">
                    @csrf
                    <div class="website_logo item_center mb-2">
                        <img src="{{ config('website_info.logoImage') }}" alt="Logo">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="text-secondary mb-2"><span class="text-danger me-1">*</span>{{ trans('messages.LABEL_EMAIL') }}</label>
                        <input type="email" name="email" id="email" autocomplete="email" class="form-control custom_focus text-secondary" value="{{ old('email') }}">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="text-secondary mb-2"><span class="text-danger me-1">*</span>{{ trans('messages.LABEL_PASSWORD') }}</label>
                        <div class="position-relative">
                            <input type="password" name="password" id="password" class="form-control custom_focus text-secondary">
                            <i class="fa-regular icon_show_password fa-eye text-secondary"></i>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center gap-1 mb-3">
                        <label for="rememberMe" class="form-check-label text-secondary fs-7 cursor_pointer">
                            <input type="checkbox" name="rememberMe" class="form-check-input custom_focus" id="rememberMe">
                            {{ trans('messages.REMEMBER_ME') }}
                        </label>
                        <a href="/" class="link-primary outline_none fs-7">{{ trans('messages.FORGOT_PASSWORD') }}</a>
                    </div>
                    
                    <button id="btnLogin" class="btn btn-primary w-100" data-trans-loading="{{ trans('messages.BTN_LABEL_LOADING') }}">
                        {{ trans('messages.BTN_TEXT_LOGIN') }}
                        <i class="fa-solid fa-arrow-right-to-bracket"></i>
                    </button>

                    <hr class="text-secondary">

                    <p class="text-secondary fs-7 text-center">
                        {{ trans('messages.NOT_HAVE_ACCOUNT') }}
                        <a href="/" class="link-primary outline_none">{{ trans('messages.CREATE_MY_ACCOUNT') }}</a>
                    </p>
                </form>
            </div>
            <div class="col-md-6 col-xl-6 d-none d-md-flex justify-content-center align-items-center" data-aos="fade-left">
                <img src="{{ asset('assets/svg/login.svg') }}" alt="Login" class="w-100 illustration">
            </div>
        </div>
    </section>

    @vite('resources/js/auth/index.js')
@endsection