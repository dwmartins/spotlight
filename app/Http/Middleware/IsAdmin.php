<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->check() && auth()->user()->active === 'Y' && in_array(auth()->user()->role, config('constants.has_access_app'))) {
            return $next($request);
        }

        if(auth()->check() && !in_array(auth()->user()->role, config('constants.has_access_app'))) {
            return redirectWithMessage('warning', '', trans('messages.NOT_HAVE_ACCESS_THIS_AREA'), 'home_page');
        }

        return redirect()->route('admin_login');
    }
}
