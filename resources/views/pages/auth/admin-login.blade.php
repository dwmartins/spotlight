@extends('layouts.base')

@section('content')
    <section class="adminLoginView container-fluid item_center vh-100 bg-gray-100">
        <form action="/app/login" method="post" class="form_admin_login w-100 bg-white p-4 rounded-4">
            @csrf

            <div class="mb-5">
                <h5 class="fw-bold custom_dark">{{ trans('messages.WELCOME_BACK') }}{{ $userName ? ", $userName!" : '' }}</h5>
                <p>{{ trans('messages.ENTER_YOUR_EMAIL_AND_PASSWORD') }}</p>
            </div>

            <div class="mb-3">
                <input type="email" name="email" id="email" autocomplete="email" placeholder="{{ trans('messages.LABEL_EMAIL') }}" class="form-control form-control-lg custom_focus text-secondary fs-6" value="{{ old('email') ?? request()->cookie('remembered_email') }}">
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

            <x-buttons.btn-primary 
                text="{{ trans('messages.BTN_TEXT_RESET_PASSWORD') }}" 
                :use-loader="true"
                id="btn_admin_login"
                type="submit"
                class="w-100 shadow"
            />
        </form>
    </section>

    @vite('resources/js/auth/index.js')
@endsection