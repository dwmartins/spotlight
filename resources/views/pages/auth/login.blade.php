@extends('layouts.base')

@section('content')
    <section class="publicLoginView container-fluid item_center vh-100 bg-gray-100 position-relative">
        <div class="cover-image-login rounded-bottom-4" style="background-image: url({{ asset('assets/images/cover-image-auth.jpg') }})"></div>

        <form action="/login" method="post" class="form_login w-100 bg-white p-4 rounded-4 position-relative z-1">
            @csrf

            <div class="mb-4">
                @if ($userName)
                    <h5 class="fw-bold custom_dark truncate-text ">{{ trans('messages.WELCOME_BACK') }}, {{ $userName }}!</h5>
                @else
                    <h5 class="fw-bold custom_dark">{{ trans('messages.WELCOME') }}</h5>
                @endif

                <p>{{ trans('messages.ENTER_YOUR_EMAIL_AND_PASSWORD') }}</p>
            </div>

            <div class="mb-3">
                <input type="email" name="email" id="email" autocomplete="email" placeholder="{{ trans('messages.LABEL_EMAIL') }}" class="form-control form-control-lg custom_focus text-secondary fs-6" value="{{ old('email') ?? request()->query('email') ?? request()->cookie('remembered_email') }}">
            </div>

            <div class="mb-4">
                <div class="position-relative">
                    <input type="password" name="password" id="password" placeholder="{{ trans('messages.LABEL_PASSWORD') }}" class="form-control form-control-lg custom_focus text-secondary fs-6">
                    <i class="fa-regular icon_show_password fa-eye text-secondary"></i>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center gap-1 mb-4 px-1">
                <label for="rememberMe" class="d-flex align-items-center gap-2 form-check-label text-secondary fs-7 cursor_pointer">
                    <input class="switch" name="rememberMe" id="rememberMe" type="checkbox">
                    {{ trans('messages.REMEMBER_ME') }}
                </label>
                <a href="{{ route('recover_password') }}" class="link-primary outline_none fs-7">{{ trans('messages.FORGOT_PASSWORD') }}</a>
            </div>

            <button id="btnLogin" class="btn btn-primary btn-lg w-100 fs-6 shadow" data-trans-loading="{{ trans('messages.BTN_LABEL_LOADING') }}">
                {{ trans('messages.BTN_TEXT_LOGIN') }}
                <i class="fa-solid fa-arrow-right-to-bracket"></i>
            </button>

            <hr class="text-secondary">

            <p class="text-secondary fs-7 text-center">
                {{ trans('messages.NOT_HAVE_ACCOUNT') }}
                <a href="{{ route('register') }}" class="link-primary outline_none">{{ trans('messages.CREATE_MY_ACCOUNT') }}</a>
            </p> 
        </form>
    </section>

    @vite('resources/js/auth/index.js')
@endsection