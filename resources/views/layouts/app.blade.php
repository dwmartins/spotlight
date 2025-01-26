@extends('layouts.base')

@section('content')
    <section class="app_layout">
        <!-- ======= Header ======= -->
        <header id="header" class="header fixed-top d-flex align-items-center">
            <h5 class="custom-text-white mb-0">{{$page_name}}</h5>
            <nav class="header-nav ms-auto">
                <ul class="d-flex align-items-center">
                    <a href="javascript:void(0);" class="text-white me-4">
                        <i class="fa-solid fa-bars toggle-sidebar-btn mt-1"></i>
                    </a>
                    
                    <li class="nav-item dropdown">

                        <a class="nav-link nav-icon mt-2" href="javascript:void(0);" data-bs-toggle="dropdown">
                            <i class="fa-regular fa-bell"></i>
                            <span class="badge bg-white text-dark badge-number">4</span>
                        </a><!-- End Notification Icon -->

                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                            <li class="dropdown-header">
                                You have 4 new notifications
                                <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li class="notification-item">
                                <i class="bi bi-exclamation-circle text-warning"></i>
                                <div>
                                    <h4>Lorem Ipsum</h4>
                                    <p>Quae dolorem earum veritatis oditseno</p>
                                    <p>30 min. ago</p>
                                </div>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li class="notification-item">
                                <i class="bi bi-x-circle text-danger"></i>
                                <div>
                                    <h4>Atque rerum nesciunt</h4>
                                    <p>Quae dolorem earum veritatis oditseno</p>
                                    <p>1 hr. ago</p>
                                </div>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li class="notification-item">
                                <i class="bi bi-check-circle text-success"></i>
                                <div>
                                    <h4>Sit rerum fuga</h4>
                                    <p>Quae dolorem earum veritatis oditseno</p>
                                    <p>2 hrs. ago</p>
                                </div>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li class="notification-item">
                                <i class="bi bi-info-circle text-primary"></i>
                                <div>
                                    <h4>Dicta reprehenderit</h4>
                                    <p>Quae dolorem earum veritatis oditseno</p>
                                    <p>4 hrs. ago</p>
                                </div>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li class="dropdown-footer">
                                <a href="#">Show all notifications</a>
                            </li>

                        </ul><!-- End Notification Dropdown Items -->

                    </li><!-- End Notification Nav -->

                    <li class="nav-item dropdown">

                        <a class="nav-link nav-icon mt-2" href="javascript:void(0);" data-bs-toggle="dropdown">
                            <i class="fa-regular fa-message"></i>
                            <span class="badge bg-white text-dark badge-number">3</span>
                        </a><!-- End Messages Icon -->

                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
                            <li class="dropdown-header">
                                You have 3 new messages
                                <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li class="message-item">
                                <a href="#">
                                    <img src="assets/img/messages-1.jpg" alt="" class="rounded-circle">
                                    <div>
                                        <h4>Maria Hudson</h4>
                                        <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                        <p>4 hrs. ago</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li class="message-item">
                                <a href="#">
                                    <img src="assets/img/messages-2.jpg" alt="" class="rounded-circle">
                                    <div>
                                        <h4>Anna Nelson</h4>
                                        <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                        <p>6 hrs. ago</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li class="message-item">
                                <a href="#">
                                    <img src="assets/img/messages-3.jpg" alt="" class="rounded-circle">
                                    <div>
                                        <h4>David Muldon</h4>
                                        <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                        <p>8 hrs. ago</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li class="dropdown-footer">
                                <a href="#">Show all messages</a>
                            </li>

                        </ul><!-- End Messages Dropdown Items -->

                    </li><!-- End Messages Nav -->

                    <li class="nav-item dropdown pe-3">

                        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="javascript:void(0);" data-bs-toggle="dropdown">
                            <img src="{{ auth()->user()->getAvatar() }}" alt="Profile">
                            <span class="d-none d-md-block dropdown-toggle ps-2 text-black fs-6">{{ auth()->user()->name }}</span>
                        </a><!-- End Profile Iamge Icon -->

                        <ul class="dropdown-menu dropdown-profile shadow">
                            <li>
                                <a href="{{ route('user_panel') }}" class="dropdown-item text-secondary">
                                    <i class="fa-solid fa-chart-line me-2"></i>{{ trans('messages.NAV_NAME_PANEL') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user_profile') }}" class="dropdown-item text-secondary">
                                    <i class="fa-regular fa-user me-2"></i>{{ trans('messages.NAV_NAME_PROFILE') }}
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <span class="dropdown-item text-secondary cursor_pointer" onclick="document.getElementById('logout-form').submit()">
                                    <i class="fa-solid fa-right-from-bracket me-2"></i>{{ trans('messages.NAV_NAME_LOGOUT') }}
                                </span>
                            </li>
                        </ul><!-- End Profile Dropdown Items -->
                    </li><!-- End Profile Nav -->

                </ul>
            </nav><!-- End Icons Navigation -->

        </header><!-- End Header -->

        <!-- ======= Sidebar ======= -->
        <aside id="sidebar" class="sidebar">

            <ul class="sidebar-nav" id="sidebar-nav">
                <div class="logo item_center">
                    <img src="{{ config('website_info.logoImage') }}" alt="Logo">

                    <a href="javascript:void(0);" class="custom-text-dark close_nav_mobile d-none">
                        <i class="fa-solid fa-xmark toggle-sidebar-btn fs-2 ms-4"></i>
                    </a>
                </div>
                
                <hr class="text-secondary m-0 mb-2">

                <li class="nav-item">
                    <a class="nav-link collapsed" href="/app">
                        <i class="fa-solid fa-chart-line"></i>
                        <span>Dashboard</span>
                    </a>
                </li><!-- End Dashboard Nav -->

                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#contents-nav" data-bs-toggle="collapse" href="javascript:void(0);">
                        <i class="fa-solid fa-list"></i><span>Conteúdos</span><i class="fa-solid fa-chevron-down ms-auto"></i>
                    </a>
                    <ul id="contents-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="#" class="outline_none">
                                <i class="fa-regular fa-circle"></i></i><span>Anúncios</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="outline_none">
                                <i class="fa-regular fa-circle"></i></i><span>Eventos</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="outline_none">
                                <i class="fa-regular fa-circle"></i></i><span>Blog</span>
                            </a>
                        </li>
                    </ul>
                </li><!-- End Contents Nav -->

                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#settings-nav" data-bs-toggle="collapse" href="javascript:void(0);">
                        <i class="fa-solid fa-gears"></i><span>Configurações</span><i class="fa-solid fa-chevron-down ms-auto"></i>
                    </a>
                    <ul id="settings-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="/" class="outline_none">
                                <i class="fa-regular fa-circle"></i><span>Informações básicas</span>
                            </a>
                        </li>
                        <li>
                            <a href="/" class="outline_none">
                                <i class="fa-regular fa-circle"></i><span>Configurações gerais</span>
                            </a>
                        </li>
                        <li>
                            <a href="/" class="outline_none">
                                <i class="fa-regular fa-circle"></i><span>E-mail</span>
                            </a>
                        </li>
                        <li>
                            <a href="/" class="outline_none">
                                <i class="fa-regular fa-circle"></i><span>Editor CSS</span>
                            </a>
                        </li>
                    </ul>
                </li><!-- End Settings Nav -->

                <li class="nav-item">
                    <a class="nav-link collapsed" href="/app">
                        <i class="fa-regular fa-user"></i>
                        <span>Usuários</span>
                    </a>
                </li><!-- End Users Nav -->
            </ul>

        </aside><!-- End Sidebar-->

        <!-- Main Content -->
        <main id="main" class="main px-3">
            @yield('main-content')
        </main>

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center outline_none"><i class="fa-solid fa-arrow-up"></i></a>
    </section>
@endsection
