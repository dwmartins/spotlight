<nav class="navbar navbar-expand-lg bg-body-tertiary mx-0 p-0 py-2 public_nav">
    <div class="container">
        <a href="/" class="navbar-brand">
            <div class="d-flex align-items-center logo_image">
                <img src="{{ config('website_info.logoImage') }}" alt="Logo">
            </div>
        </a>

        <button class="btn border-0 navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navBar" aria-controls="navBar" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa-solid fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="navBar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <!-- logged in user -->
                @auth
                    <div>
                        <li class="nav-item logged_small">
                            <i class="bi bi-person-fill me-1 "></i>
                            <p class="m-0 text-secondary">{{ auth()->user()->name }} {{ auth()->user()->last_name }}</p>
                        </li>
                        <hr>

                        <li class="nav-item logged_small">
                            <a href="{{ route('user_panel') }}" class="nav-link">
                                {{ trans('navigation.panel') }}
                            </a>
                        </li>

                        <li class="nav-item logged_small">
                            <a href="{{ route('user_profile') }}" class="nav-link">
                                {{ trans('navigation.profile') }}
                            </a>
                        </li>
                        <li class="nav-item logged_small">
                            <span class="nav-link cursor_pointer" onclick="document.getElementById('logout-form').submit()">
                                {{ trans('navigation.logout') }}
                            </span>
                        </li>
                    </div>
                @endauth

                <li class="nav-item">
                    <a href="/" class="nav-link">
                        {{ trans('navigation.home') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/" class="nav-link">
                        {{ trans('navigation.listings') }}
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/" class="nav-link">
                        {{ trans('navigation.events') }}
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/" class="nav-link">
                        {{ trans('navigation.blog') }}
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/" class="nav-link">
                        {{ trans('navigation.contact') }}
                    </a>
                </li>

                @guest
                    <hr>
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link logged_small">
                            {{ trans('navigation.login') }}
                        </a>
                    </li>
                @endguest

            </ul>

            <!-- logged in user -->
            @auth
                <div class="logged_large">
                    <button class="btn btn-light border btn-sm me-2 fw-semibold text-dark opacity-75">
                        <a href="/" class="nav-link">
                            {{ trans('navigation.button_advertise_here') }}
                        </a>
                    </button>

                    <div class="dropdown">
                        <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ auth()->user()->name }}
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ route('user_panel') }}" class="dropdown-item text-secondary">
                                    <i class="fa-solid fa-chart-line me-2"></i>{{ trans('navigation.panel') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user_profile') }}" class="dropdown-item text-secondary">
                                    <i class="fa-regular fa-user me-2"></i>{{ trans('navigation.profile') }}
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <span class="dropdown-item text-secondary cursor_pointer" onclick="document.getElementById('logout-form').submit()">
                                    <i class="fa-solid fa-right-from-bracket me-2"></i>{{ trans('navigation.logout') }}
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            @endauth

            @guest
                <div class="flex logged_large">
                    <a href="/" class="btn btn-light border btn-sm me-2 fw-semibold text-dark opacity-75">
                        {{ trans('navigation.button_advertise_here') }}
                    </a>

                    <a href="{{ route('login') }}" class="btn btn-primary btn-sm fw-semibold rounded-1">
                        {{ trans('navigation.login') }}
                    </a>
                </div>
            @endguest

        </div>
    </div>
</nav>
