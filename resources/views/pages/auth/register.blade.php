@extends('layouts.base')

@section('content')

    <section class="registerView container-fluid item_center vh-100 bg-gray-100 position-relative">
        <div class="cover-image-auth rounded-4" style="background-image: url({{ asset('assets/images/cover-image-auth.jpg') }})"></div>

        <form action="/register" method="post" class="form_register w-100 bg-white p-4 rounded-4 position-relative z-1">
            @csrf
            <div class="website_logo item_center mb-4">
                <img src="{{ config('website_info.logoImage') }}" alt="Logo">
            </div>
            
            <div class="mb-3">
                <input type="text" name="name" id="name" autocomplete="name" placeholder="{{ trans('messages.LABEL_NAME') }}" class="form-control form-control-lg fs-6 custom_focus" value="{{ old('name')}}">
            </div>

            <div class="mb-3">
                <input type="text" name="lastName" id="lastName" placeholder="{{ trans('messages.LABEL_LAST_NAME') }}" autocomplete="lastName" class="form-control form-control-lg fs-6 custom_focus" value="{{ old('lastName')}}">
            </div>

            <div class="mb-3">
                <input type="email" name="email" id="email" autocomplete="email" placeholder="{{ trans('messages.LABEL_EMAIL') }}" class="form-control form-control-lg fs-6 custom_focus" value="{{ old('email') }}">
            </div>

            <div class="mb-3">
                <div class="position-relative">
                    <input type="password" name="password" id="password" class="form-control form-control-lg fs-6 custom_focus" placeholder="{{ trans('messages.LABEL_PASSWORD') }}">
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
    </section>

@vite('resources/js/auth/index.js')

@endsection