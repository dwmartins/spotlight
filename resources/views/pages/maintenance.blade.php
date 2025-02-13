@extends('layouts.base')

@section('content')
    <section class="maintenanceView container vh-100 item_center">
        <div class="w-100 d-flex flex-column align-items-center">
            <img src="{{ asset('assets/svg/maintenance.svg') }}" alt="maintenance">
            <h4 class="text-center">{{ trans('messages.maintenance') }}</h4>
            <p>
                {{ trans('messages.are_you_an_administrator') }}
                <a href="{{ route('admin_login') }}" class="link-primary outline_none">{{ trans('navigation.login') }}</a>
            </p>
        </div>
    </section>
@endsection