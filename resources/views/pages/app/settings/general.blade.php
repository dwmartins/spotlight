@extends('layouts.app')

@section('main-content')
    <div class="min-height-300 bg-primary w-100 position-absolute top-0 start-0 z-1"></div>

    <section class="position-relative z-1 container-fluid general-settings-view">
        @include('forms.app.settings.maintenance')
        @include('forms.app.settings.language')
    </section>

    @vite('resources/js/panel/settings/general.js')
@endsection