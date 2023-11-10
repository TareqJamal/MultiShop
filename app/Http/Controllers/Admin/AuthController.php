<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\RecoverPasswordEmail;
use App\Mail\VerifyEmailMail;
use App\Models\Admin;
use App\Models\AdminCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function checkLogin(Request $request)
    {
        if ($request->role != null)
            if ($request->role == 'employee') {
                if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
                    $admin = Admin::where('email', $request->email)->first();
                    if ($admin->is_verified == 1) {
                        session(['statusAdmin' => true]);
                        return response()
                            ->json([
                                'success' => 'Welcome back , Employee',
                                'redirect' => route('main.index')
                            ]);
                    } else {
                        $adminCode = AdminCode::create([
                            'email' => $request->email,
                            'code' => mt_rand(100000, 999999)
                        ]);
                        Mail::to($request->email)->send(new VerifyEmailMail($adminCode));
                        return response()->json(['error' => 'Please verify your email , Go to your inbox']);
                    }

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
                            'redirect' => route('main.index')
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
        return redirect(url('dashboard/login'));
    }


    public function checkEmailorPhone(Request $request)
    {
        $email = $request->email;
        if (Admin::checkEmail($email)) {
            Mail::to($request->email)->send(new RecoverPasswordEmail());
            return response()->json([
                'success' => 'Check your Email',
            ]);
        } else {
            return response()->json([
                'error' => 'Sorry , there is no phone number or email. You must register first',
                'redirect' => route('loginPage')
            ]);
        }
    }

    public function recoverPasswordPage()
    {
        return view('Admin.auth.recover_password');
    }

    public function recoverPassword(Request $request)
    {
        if ($request->newPassword == $request->confirmPassword) {
            $admin = Admin::all()->where('email', '=', $request->email)->first();
            $admin->update(['password' => Hash::make($request->newPassword)]);
            return response()->json([
                'success' => 'Reset Password done successfully',
                'redirect' => route('loginPage')
            ]);
        } else {
            return response()->json(['error' => 'Password Not Match']);
        }

    }

    public function verifyEmailPage()
    {
        return view('Admin.auth.verifyEmail');
    }

    public function checkVerifyCode(Request $request)
    {
        $object = AdminCode::where('code', $request->code)->first();
        if (isset($object)) {
            $admin = Admin::where('email', $object->email)->first();
            $admin->is_verified = 1;
            $admin->save();
            return response()->json([
                'success' => 'Email Verifying Success',
                'redirect' => route('loginPage')
            ]);

        } else {
            return response()->json([
                'error' => 'The Code is Wrong',
            ]);
        }
    }
}
