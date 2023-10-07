<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class Auth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // Check if the user is authenticated with the 'statusAdmin' guard or the 'statusSuper' guard.
        if (\Illuminate\Support\Facades\Auth::guard('admin')->check() || \Illuminate\Support\Facades\Auth::guard('web')->check()) {
            return $next($request);
        } else {
            return redirect(url('dashboard/login'));
        }

//        if(Session::has('statusAdmin') || Session::has('statusSuper'))
//        {
//            return $next($request);
//        }
//        else{
//            return redirect(url('/login'));
//        }

    }
}
