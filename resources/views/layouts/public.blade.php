@extends('layouts.base')

@section('title', 'Site - Minha Aplicação')

@section('content')
    @include('components.admin.adminBar')
    @include('components.public.header')

    <main class="container mt-4">
        @yield('main-content')
    </main>

    @include('components.public.footer')
@endsection
