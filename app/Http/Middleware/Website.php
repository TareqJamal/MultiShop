<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class Website
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Session::has('webSiteStatus') && \Illuminate\Support\Facades\Auth::guard('customer')->check())
        {
            return $next($request);
        }
        else
        {
            return redirect(route('WebsiteLoginPage'));
        }

    }
}
