@extends('layouts.base')

@section('title', 'Site - Minha Aplicação')

@section('content')
    <header>
        <!-- Navbar do site -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="#">Minha Aplicação</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="/sobre">Sobre</a></li>
                        <li class="nav-item"><a class="nav-link" href="/contato">Contato</a></li>
                        <li class="nav-item"><a class="nav-link" href="/app">Panel</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="container mt-4">
        @yield('main-content')
    </main>

    <footer class="text-center py-4">
        <p>&copy; 2025 Minha Aplicação. Todos os direitos reservados.</p>
    </footer>
@endsection
