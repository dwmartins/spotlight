@extends('layouts.base')

@section('content')

    <section class="registerView container-fluid item_center vh-100 bg-gray-100 position-relative">
        <div class="cover-image-auth rounded-bottom-4" style="background-image: url({{ asset('assets/images/cover-image-auth.jpg') }})"></div>

        <form action="/register" method="post" class="form_register w-100 bg-white p-4 rounded-4 position-relative z-1">
            @csrf
            <div class="website_logo item_center mb-4">
                <img src="{{ config('website_info.logoImage') }}" alt="Logo">
            </div>
            
            <div class="mb-3">
                <input type="text" name="name" id="name" autocomplete="name" placeholder="{{ trans('form.label_name') }}" class="form-control form-control-lg fs-6 custom_focus" value="{{ old('name')}}">
            </div>

            <div class="mb-3">
                <input type="text" name="lastName" id="lastName" placeholder="{{ trans('form.label_last_name') }}" autocomplete="lastName" class="form-control form-control-lg fs-6 custom_focus" value="{{ old('lastName')}}">
            </div>

            <div class="mb-3">
                <input type="email" name="email" id="email" autocomplete="email" placeholder="{{ trans('form.label_email') }}" class="form-control form-control-lg fs-6 custom_focus" value="{{ old('email') }}">
            </div>

            <div class="mb-3">
                <div class="position-relative">
                    <input type="password" name="password" id="password" class="form-control form-control-lg fs-6 custom_focus" placeholder="{{ trans('form.label_password') }}">
                    <i class="fa-regular icon_show_password fa-eye text-secondary"></i>
                </div>
            </div>

            <div class="fs-8 text-secondary text-center mb-3">
                {{ trans('messages.accept_our_privacy') }}
                <a href="/" class="text-primary outline_none">{{ trans('messages.privacy_page') }}</a>
            </div>

            <x-buttons.btn-primary 
                text="{{ trans('messages.btn_text_create_account') }}" 
                :use-loader="true"
                onclick="toggleLoading(this, true, true)"
                type="submit"
                class="w-100 shadow"
            />  

            <hr class="text-secondary">

            <p class="text-secondary text-center">
                {{ trans('messages.have_account') }}
                <a href="{{ route('login') }}" class="text-primary outline_none">{{ trans('navigation.login') }}</a>
            </p>
        </form>
    </section>

@vite('resources/js/auth/index.js')

@endsection