<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function checkLogin(Request $request)
    {
        if ($request->role == 'employee') {
            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
                session(['statusAdmin' => true]);
                return response()
                    ->json([
                        'success'=>'Welcome back , Employee' ,
                        'redirect'=>route('admins.index')
                    ]);
            } else {
                return response()
                    ->json([
                        'message'=>'Sorry , Email or Password is Incorrect',
                        'redirect'=>redirect()->back()
                    ]);
            }
        } elseif ($request->role == 'manager') {
            if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
                session(['statusSuper' => true]);
                return response()
                    ->json([
                        'success'=>'Welcome back , Manager' ,
                        'redirect'=>route('admins.index')
                    ]);
            } else {
                return response()
                    ->json([
                        'message'=>'Sorry , Email or Password is Incorrect',
                        'redirect'=>redirect()->back()
                    ]);
            }
        }

    }
    public function logout()
    {
        Session::flush();
        return redirect(url('/login'));
    }
}
