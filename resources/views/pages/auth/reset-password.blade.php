@extends('layouts.base')

@section('content')
    <section class="resetPasswordView container-fluid item_center vh-100 bg-gray-100 position-relative">
        <div class="cover-image-reset-password rounded-bottom-4" style="background-image: url({{ asset('assets/images/cover-image-auth.jpg') }})"></div>

        <form action="/reset-password" method="post" class="form_reset_password w-100 bg-white p-4 rounded-4 position-relative z-1">
            @csrf
            <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">
            <input type="hidden" name="token" id="token" value="{{ $token }}">

            <div class="website_logo item_center mb-3">
                <img src="{{ config('website_info.logoImage') }}" alt="Logo">
            </div>

            <h4 class="mb-4 truncate-text">{{ trans('messages.hello') }}, {{ $user->name }}</h4>
            <p class="fs-7">{{ trans('messages.create_a_new_password_below') }}</p>
            
            <div class="mb-4">
                <div class="position-relative">
                    <input type="password" name="newPassword" id="newPassword" class="form-control form-control-lg fs-6 custom_focus" placeholder="{{ trans('form.label_new_password') }}">
                    <i class="fa-regular icon_show_password fa-eye text-secondary d-none"></i>
                </div>
            </div>

            <div class="mb-4">
                <div class="position-relative">
                    <input type="password" name="confirmPassword" id="confirmPassword" class="form-control form-control-lg fs-6 custom_focus" placeholder="{{ trans('form.label_confirm_password') }}">
                    <i class="fa-regular icon_show_password fa-eye text-secondary d-none"></i>
                </div>
            </div>

            <x-buttons.btn-primary 
                text="{{ trans('messages.btn_text_change_password') }}" 
                :use-loader="true"
                type="submit"
                class="w-100 shadow"
                id="btn_change_password"
            />  
        </form>
    </section>
    @vite('resources/js/auth/index.js')
@endsection