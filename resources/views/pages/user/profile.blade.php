@extends('layouts.public')

@section('main-content')
<section class="profileView container-fluid">
    <div class="container my-2 my-sm-5">
        <h2 class="custom_dark fw-bolder">{{ trans('messages.PERSONAL_INFO') }}</h2>
        <p class="text-secondary m-0">{{ trans('messages.MANAGE_PERSONAL_HERE') }}</p>

        <div class="row mt-sm-3">
            <div class="col-12 col-lg-7 col-xxl-6">
                @include('forms.user.changeAvatar')
            </div>
            <div class="col-12 col-lg-5 col-xxl-6 p-3 pt-0 d-none d-lg-flex justify-content-center align-items-baseline">
                <img src="{{ asset('assets/svg/account.svg') }}" alt="Account" class="w-100">
            </div>
        </div>
    </div>
</section>

@vite('resources/js/user/profile.js')
@endsection