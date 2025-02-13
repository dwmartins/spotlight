@extends('layouts.public')

@section('main-content')
<section class="userPanelView container-fluid">
    <div class="container my-2 my-md-5">
        <div class="row">
            <div class="col-12 col-lg-3 p-2">
                <!-- user info -->
                <div class="bg-gray-200 item_center flex-column p-3 shadow rounded rounded-2">
                    <div class="position-relative">
                        <img src="{{ auth()->user()->getAvatar() }}" alt="Avatar" class="user_photo">
                    </div>

                    <div class="d-flex flex-column align-items-center">
                        <p class="custom_dark fw-semibold mt-2 mb-0">{{ auth()->user()->getFullName() }}</p>
                        <p class="text-secondary fs-8 text-break">{{ auth()->user()->email }}</p>
                        <p class="custom_dark fw-semibold fs-8 text-break mb-0">{{ trans('messages.member_since') }}:</p>
                        <p class="text-secondary fs-8 text-break">{{ getDateAsString(auth()->user()->created_at) }}</p>

                        @if(auth()->user()->city && auth()->user()->state)
                            <p class="text-secondary fs-8 text-break">{{ auth()->user()->city }}, {{ auth()->user()->state }}</p>
                        @endif

                        <a href="{{ route('user_profile') }}" class="btn btn-sm btn-primary">{{ trans('messages.edit_profile') }}<i class="fa-solid fa-user-pen ms-2"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-9 p-2">
                <!-- Contents -->
                <div class="p-3">
                    <h5 class="custom_dark fw-semibold">{{ setGreeting() }} {{ auth()->user()->name }}</h5>
                    <p class="text-secondary">{{ trans('messages.welcome_to_you_area') }}</p>
                </div>

                <hr class="text-secondary">

                <div class="d-flex flex-column align-items-center">
                    <img src="{{ asset('assets/svg/empty.svg') }}" class="img_no_ads" alt="No data">
                    <p class="text-secondary text-center">{{ trans('messages.dont_have_ads') }}</p>
                    <a href="/" class="btn btn-outline-primary">{{ trans('messages.advertise_now') }}<i class="fa-solid fa-arrow-up-right-from-square ms-2"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection