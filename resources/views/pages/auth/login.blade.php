@extends('layouts.public')

@section('main-content')
    <section class="publicLoginView container item_center">
        <div class="row w-100">
            <div class="col-sm-12 col-md-6 col-xl-7 item_center" data-aos="fade-right">
                <form action="{{ route('login') }}" method="post" class="form_login w-100">
                    @csrf
                    <h1 class="text-center text-secondary-emphasis mb-3">Entrar</h1>

                    <div class="mb-3">
                        <label for="email" class="text-secondary mb-2"><span class="text-danger me-1">*</span>E-mail</label>
                        <input type="email" name="email" id="email" autocomplete="email" class="form-control custom_focus text-secondary" value="{{ old('email') }}">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="text-secondary mb-2"><span class="text-danger me-1">*</span>Senha</label>
                        <div class="position-relative">
                            <input type="password" name="password" id="password" class="form-control custom_focus text-secondary">
                            <i class="fa-regular icon_show_password fa-eye text-secondary"></i>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center gap-1 mb-3">
                        <label for="rememberMe" class="form-check-label text-secondary fs-7 cursor_pointer">
                            <input type="checkbox" name="rememberMe" class="form-check-input custom_focus" id="rememberMe">
                            Lembrar de mim
                        </label>
                        <a href="/" class="outline_none text-primary fs-7">Esqueci minha senha</a>
                    </div>

                    <button id="btnLogin" class="btn btn-primary w-100">
                        Entrar
                        <i class="fa-solid fa-arrow-right-to-bracket"></i>
                    </button>

                    <hr class="text-secondary">

                    <p class="text-secondary fs-7 text-center">
                        Não possui conta?
                        <a href="/" class="text-primary outline_none">Criar minha conta</a>
                    </p>
                </form>
            </div>
            <div class="col-md-6 col-xl-5 d-none d-md-flex justify-content-center align-items-center" data-aos="fade-left">
                <img src="{{ asset('assets/svg/login.svg') }}" alt="Login" class="w-100">
            </div>
        </div>
    </section>

    @vite('resources/js/auth/index.js')
@endsection