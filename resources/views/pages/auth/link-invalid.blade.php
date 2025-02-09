@extends('layouts.base')

@section('content')
    <section class="invalidLinkView vh-100 item_center">
        <div class="w-100 d-flex flex-column align-items-center px-2 text-center">
            <img src="{{ asset('assets/svg/invalid-link.svg') }}" alt="Invalid link">
            <h3>{{ trans('messages.LINK_INVALID_OR_EXPIRED') }}</h3>
            <a href="/" class="outline_none custom-link">{{ trans('messages.RETURN_HOME_PAGE') }}</a>
        </div>
    </section>
@endsection