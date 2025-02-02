@extends('layouts.app')

@section('main-content')
    <div class="min-height-300 bg-primary w-100 position-absolute top-0 start-0 z-1"></div>

    <section class="position-relative z-1 container-fluid email-settings-view">
        <form action="/app/settings/email" method="post" class="card mb-3 custom-bg-white custom-text-dark rounded-3 border-0 shadow">
            @csrf
            <div class="card-body">
                <h5 class="card-title">{{ trans('messages.EMAIL_SETTINGS_TITLE') }}</h5>

                <div class="row mt-4">
                    <div class="mb-4 col-sm-6">
                        <label for="host" class="form-label text-secondary text-secondary">{{ trans('messages.LABEL_SERVER') }}</label>
                        <input type="text" name="host" class="form-control form-control custom_focus text-secondary" id="host" value="{{ old('host', $emailSettings->host ?? '') }}">
                    </div>
    
                    <div class="mb-4 col-sm-3">
                        <label for="port" class="form-label text-secondary">{{ trans('messages.LABEL_PORT') }}</label>
                        <input type="number" name="port" class="form-control form-control custom_focus text-secondary" id="port" value="{{ old('port', $emailSettings->port ?? '') }}">
                    </div>

                    <div class="mb-4 col-sm-3">
                        <label class="form-label text-secondary fs-7">{{ trans('messages.LABEL_AUTHENTICATION') }}</label>
                        <select class="custom_focus text-secondary" name="authentication" id="authentication">
                            <option value="SSL">SSL</option>
                            <option value="TLS">TLS</option>
                        </select>
                    </div>
    
                    <div class="mb-4 col-sm-4">
                        <label for="from_address" class="form-label text-secondary">{{ trans('messages.LABEL_EMAIL_ADDRESS') }}</label>
                        <input name="from_address" type="text" class="form-control form-control custom_focus text-secondary" id="from_address" value="{{ old('from_address', $emailSettings->from_address ?? '') }}">
                    </div>
    
                    <div class="mb-4 col-sm-4">
                        <label for="username" class="form-label text-secondary">{{ trans('messages.LABEL_USERNAME_EMAIL') }}</label>
                        <input name="username" type="text" class="form-control form-control custom_focus text-secondary" id="username" value="{{ old('username', $emailSettings->username ?? '') }}">
                    </div>
    
                    <div class="mb-4 col-sm-4">
                        <label for="password" class="form-label text-secondary">{{ trans('messages.LABEL_PASSWORD') }}</label>
                        <div class="position-relative">
                            <input type="password" name="password" id="password" class="form-control form-control custom_focus text-secondary">
                            <i class="fa-regular icon_show_password fa-eye text-secondary"></i>
                        </div>
                    </div>
    
                    <div class="mb-2 d-flex justify-content-end">
                        <x-buttons.btn-primary-outline 
                            text="{{ trans('messages.BTN_TEXT_SAVE_CHANGES') }}" 
                            :use-loader="true"
                            onclick="toggleLoading(this, true, true)"
                            type="submit"
                        />  
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection