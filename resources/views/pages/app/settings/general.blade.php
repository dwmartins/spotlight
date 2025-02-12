@extends('layouts.app')

@section('main-content')
    <div class="min-height-300 bg-primary w-100 position-absolute top-0 start-0 z-1"></div>

    <section class="position-relative z-1 container-fluid general-settings-view pb-3">
        <div class="row d-flex">
            <div class="col-12 col-sm-6 d-flex mb-4" >
                @include('forms.app.settings.maintenance')
            </div>
            <div class="col-12 col-sm-6 d-flex mb-4">
                @include('forms.app.settings.image-optimization')
            </div>
        </div>
        
        @include('forms.app.settings.date-time')
        @include('forms.app.settings.language')
    </section>

    @vite('resources/js/dashboard/settings/general.js')
@endsection