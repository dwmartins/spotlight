@if(auth()->check() && auth()->user()->hasAppAccess())
    <section id="adminBarComponent" class="container-fluid position-sticky top-0 bg-dark z-3">
        <div class="container py-2 d-flex align-items-center justify-content-between">
            <a href="/app" class="text-white-50 outline_none hover_primary">
                <i class="fa-solid fa-house me-1"></i>
                <span class="d-none d-sm-inline-block">{{ trans('messages.dashboard') }}</span>
            </a>

            @if(config('website_settings.maintenance') === 'on')
                <div class="item_center gap-2 publish">
                    <p class="m-0 text-white-50 fs-7">{{ trans('messages.maintenance_alert') }}</p>
                    <a href="/app/settings/general" class="btn btn-sm btn-outline-primary">{{ trans('messages.publish') }}</a>
                </div>
            @endif
            
            <a href="javascript:void(0);" class="text-white-50 outline_none hover_primary" onclick="document.getElementById('logout-form').submit()">
                <span class="d-none d-sm-inline-block">{{ trans('navigation.logout') }}</span>
                <i class="fa-solid fa-right-from-bracket ms-1"></i>
            </a>
        </div>
    </section>
@endif