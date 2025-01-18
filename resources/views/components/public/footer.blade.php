<footer class="public_footer bg-gray-200">
    <div class="container py-5">
        <div class="row">
            <div class="col-12 col-sm-4 logo_footer py-2">
                <div class="h-100 w-100 d-flex flex-column justify-content-center text-center">
                    <a class="navbar-brand" href="/">
                        <div class="logo_image d-flex align-items-center justify-content-center">
                            <a href="/" class="navbar-brand">
                                <div class="d-flex align-items-center logoFooter">
                                    <img src="{{ config('website_info.logoImage')}}" alt="Logo">
                                </div>
                            </a>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-12 {{ config('website_info.facebook') ? 'col-sm-4' : 'col-sm-8' }}">
                <div class="p-2">
                    <h4 class="custom_dark fs-5">{{ trans('messages.NAVIGATION') }}</h4>

                    <div class="row align">
                        <ul class="navbar-nav col px-3">
                            <li class="nav-item">
                                <a href="{{ url('/') }}" class="nav-link">
                                    {{ trans('messages.NAV_NAME_HOME') }}
                                </a>
                                <a href="/" class="nav-link">
                                    {{ trans('messages.NAV_NAME_LISTINGS') }}
                                </a>
                                <a href="/" class="nav-link">
                                    {{ trans('messages.NAV_NAME_EVENTS') }}
                                </a>
                            </li>
                        </ul>
                        <ul class="navbar-nav col px-3">
                            <li class="nav-item">
                                <a href="/" class="nav-link">
                                    {{ trans('messages.NAV_NAME_BLOG') }}
                                </a>
                                <a href="/" class="nav-link">
                                    {{ trans('messages.NAV_NAME_CONTACT') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <hr class="text-secondary d-sm-none">
            @if (config('website_info.facebook'))
                <div class="col-12 col-sm-4">
                    <div class="p-2">
                        <h4 class="custom_dark text-center fs-5">{{ trans('messages.SOCIAL_MEDIA') }}</h4>
                        <div class="d-flex gap-3 justify-content-center p-2">
                            @if (config('website_info.x'))
                                <a href="{{ config('website_info.x') }}" target="_blank" rel="noopener noreferrer">
                                    <i class="fa-brands fa-x-twitter custom_dark fs-4"></i>
                                </a>
                            @endif
                            @if (config('website_info.facebook'))
                                <a href="{{ config('website_info.facebook') }}" target="_blank" rel="noopener noreferrer">
                                    <i class="fa-brands fa-facebook custom_dark fs-4"></i>
                                </a>
                            @endif
                            @if (config('website_info.instagram'))
                                <a href="{{ config('website_info.instagram') }}" target="_blank" rel="noopener noreferrer">
                                    <i class="fa-brands fa-instagram custom_dark fs-4"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="container-fluid gap-3 bg-gray-800 p-3">
        <div class="container">
            <div class="row">
                <p class="col-12 col-sm-6 text-light m-0 fs-7 text-center mb-2 mb-sm-0">
                    {{ trans('messages.DEVELOPED_BY') }}
                    <a href="https://br.linkedin.com/in/douglas-martins-a36a45185" target="_blank" rel="noopener noreferrer" class="text-white link-offset-2 link-underline link-underline-opacity-0 opacity-75">Douglas Wellington Martins</a>
                </p>
                <p class="col-12 col-sm-6 text-light m-0 fs-7 text-center">
                    {{ trans('messages.ILLUSTRATIONS_BY') }}
                    <a href="https://storyset.com" target="_blank" rel="noopener noreferrer" class="text-white link-offset-2 link-underline link-underline-opacity-0 opacity-75">Storyset</a>
                </p>
            </div>
        </div>
    </div>
</footer>