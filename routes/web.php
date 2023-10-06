<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SizeController;
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
        Route::group(['prefix'=>'dashboard','middleware'=>'MyAuth'],function ()
        {
            Route::resource('admins',AdminController::class);
            Route::resource('stores-types',StoreTypeController::class);
            Route::resource('stores',StoreController::class);
            Route::resource('categories',CategoryController::class);
            Route::resource('coupons',CouponController::class);
            Route::resource('products',ProductController::class);
            Route::resource('attributes',AttributeController::class);
            Route::resource('sizes',SizeController::class);
            Route::resource('colors',ColorController::class);
            Route::resource('images',ImageController::class);
            Route::get('/logout',[AuthController::class,'logout'])->name('logout');
            Route::get('/', function () {

                return view('Admin.home.index');
            });
        });
        Route::view('/login','Admin.auth.login')->name('loginPage');
        Route::view('/forgetPassword','Admin.auth.forget_password')->name('forgetPasswordPage');
        Route::get('/recoverPassword/{email}',[AuthController::class,'recoverPasswordPage']);
        Route::post('/login/check',[AuthController::class,'checkLogin'])->name('checkLogin');
        Route::post('/forgetPassword/check',[AuthController::class,'checkEmailorPhone'])->name('checkEmailorPhone');
        Route::post('/recoverPassword/{email}',[AuthController::class,'recoverPassword'])->name('recoverPassword');




});
