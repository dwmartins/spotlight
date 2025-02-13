@extends('layouts.base')

@section('content')
    <section class="recoverPasswordView container-fluid item_center vh-100 bg-gray-100 position-relative">
        <div class="cover-image-reset-password rounded-bottom-4" style="background-image: url({{ asset('assets/images/cover-image-auth.jpg') }})"></div>

        <form class="form_recover_password w-100 bg-white p-4 rounded-4 position-relative z-1">
            @csrf
            <h5 class="mb-1">{{ trans('messages.cant_log_in') }}</h5>
            <p>{{ trans('messages.restore_access_account') }}</p>

            <div class="mb-4 mt-4">
                <label for="email" class="fw-bold mb-2 fs-7">{{ trans('form.label_send_recovery_link') }}</label>
                <input type="email" name="email" id="email" autocomplete="email" placeholder="{{ trans('form.label_your_email') }}" class="form-control form-control-lg custom_focus text-secondary fs-6" value="{{ old('email') }}">
            </div>

            <x-buttons.btn-primary 
                text="{{ trans('messages.btn_text_reset_password') }}" 
                :use-loader="true"
                id="btn_send_code"
                type="submit"
                class="w-100 shadow"
            />  
        </form>
    </section>
    @vite('resources/js/auth/index.js')
@endsection