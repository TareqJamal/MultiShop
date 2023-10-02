<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function checkLogin(Request $request)
    {
        if ($request->role != null)
            if ($request->role == 'employee') {
                if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
                    session(['statusAdmin' => true]);
                    return response()
                        ->json([
                            'success' => 'Welcome back , Employee',
                            'redirect' => route('admins.index')
                        ]);
                } else {
                    return response()
                        ->json([
                            'error' => 'Sorry , Email or Password is Incorrect',
                        ]);
                }
            } elseif ($request->role == 'manager') {
                if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
                    session(['statusSuper' => true]);
                    return response()
                        ->json([
                            'success' => 'Welcome back , Manager',
                            'redirect' => route('admins.index')
                        ]);
                } else {
                    return response()
                        ->json([
                            'error' => 'Sorry , Email or Password is Incorrect',
                        ]);
                }
            } else {
                return response()
                    ->json([
                        'error' => 'Sorry , Please Choose Your Role ',
                    ]);
            }

    }

    public function logout()
    {
        Session::flush();
        return redirect(url('/login'));
    }


    public function checkEmailorPhone(Request $request)
    {
        $email = $request->email;
        if (Admin::checkEmail($email)) {
            return response()->json([
                'success' => 'Ok, You are registered with us',
                'email' => $email
            ]);
        } else {
            return response()->json([
                'error' => 'Sorry , there is no phone number or email. You must register first',
                'redirect' => route('loginPage')
            ]);
        }
    }

    public function recoverPasswordPage($email)
    {
        return view('Admin.auth.recover_password', compact('email'));
    }

    public function recoverPassword(Request $request, $email)
    {
            if ($request->newPassword == $request->confirmPassword) {
                $admin = Admin::all()->where('email', '=',$email)->first();
                $admin->update(['password'=>Hash::make($request->newPassword)]);
                return response()->json([
                    'success' => 'Reset Password done successfully',
                    'redirect' => route('loginPage')
                ]);
            } else {
                return response()->json(['error' => 'Password Not Match']);
            }

    }
}
