@extends('layouts.base')

@section('content')
    <section class="maintenanceView container vh-100 item_center">
        <div class="w-100 d-flex flex-column align-items-center">
            <img src="{{ asset('assets/svg/maintenance.svg') }}" alt="maintenance">
            <h4 class="text-center">{{ trans('messages.MAINTENANCE') }}</h4>
            <p>
                {{ trans('messages.ARE_YOU_AN_ADMINISTRATOR') }}
                <a href="{{ route('admin_login') }}" class="link-primary outline_none">{{ trans('messages.NAV_NAME_LOGIN') }}</a>
            </p>
        </div>
    </section>
@endsection