<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Session\Session as SessionSession;

class CheckForMaintenance
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if(config('website_settings.maintenance') === 'on') {
            if (auth()->check()) {
                $user = auth()->user();
    
                if ($user->active === 'Y' && in_array($user->role, config('constants.has_access_app'))) {
                    return $next($request);
                }
            }

            if($request->is('app*') || $request->is('logout')) {
                return $next($request);
            }

            return response()->view('pages.maintenance');
        }

        return $next($request);
    }
}
