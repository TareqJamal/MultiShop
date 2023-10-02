<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\StoreTypeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){

        Route::resource('admins',AdminController::class);
        Route::resource('stores-types',StoreTypeController::class);
        Route::resource('stores',StoreController::class);
        Route::view('/login','Admin.auth.login')->name('loginPage');
        Route::view('/forgetPassword','Admin.auth.forget_password')->name('forgetPasswordPage');
        Route::get('/recoverPassword/{email}',[AuthController::class,'recoverPasswordPage']);
        Route::post('/login/check',[AuthController::class,'checkLogin'])->name('checkLogin');
        Route::post('/forgetPassword/check',[AuthController::class,'checkEmailorPhone'])->name('checkEmailorPhone');
        Route::post('/recoverPassword/{email}',[AuthController::class,'recoverPassword'])->name('recoverPassword');
        Route::get('/logout',[AuthController::class,'logout'])->name('logout');


    Route::get('/', function () {

        return view('Admin.home.index');
    });
});
