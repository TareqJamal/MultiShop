<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class WebSiteAuthController extends Controller
{
    public function checkLogin(Request $request)
    {
        $credentials = ['email' => $request->email, 'password' => $request->password];
        if (Auth::guard('customer')->attempt($credentials))
        {
            Session::put(['webSiteStatus'=>true]);
            return response()->json([
                'success'=>'Welcome back to you Store',
                'redirect'=> route('home.index')
            ]);
        }
        else
        {
            return response()->json([
                'error'=>'Sorry, Email or Password is invalid',
            ]);
        }
    }
    public function logout()
    {
        Session::flash('webSiteStatus');
        return redirect(route('WebsiteLoginPage'));

    }
}
