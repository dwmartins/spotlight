@extends('layouts.base')

@section('title', 'Admin - Minha Aplicação')

@section('content')
    <div class="d-flex" style="min-height: 100vh;">
        <!-- Sidebar -->
        <aside class="bg-dark text-white p-3" style="width: 250px;">
            <h4>Admin Panel</h4>
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link text-white" href="/admin/dashboard">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="/admin/usuarios">Usuários</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="/admin/configuracoes">Configurações</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="flex-grow-1 p-4">
            <h1>Admin Panel</h1>
            @yield('main-content')
        </main>
    </div>
@endsection
