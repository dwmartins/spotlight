@extends('layouts.base')

@section('content')
    <section class="invalidLinkView vh-100 item_center">
        <div class="w-100 d-flex flex-column align-items-center px-2 text-center">
            <img src="{{ asset('assets/svg/invalid-link.svg') }}" alt="Invalid link">
            <h3>{{ trans('messages.link_invalid_or_expired') }}</h3>
            <a href="/" class="outline_none custom-link">{{ trans('messages.return_home_page') }}</a>
        </div>
    </section>
@endsection