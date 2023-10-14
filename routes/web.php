<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReviewDashboardController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\StoresStatusController;
use App\Http\Controllers\Admin\StoreTypeController;
use App\Http\Controllers\Site\ApplyCouponContoller;
use App\Http\Controllers\Site\CartController;
use App\Http\Controllers\Site\CheckoutController;
use App\Http\Controllers\Site\ContactController;
use App\Http\Controllers\Site\CustomerController;
use App\Http\Controllers\Site\HomeSiteController;
use App\Http\Controllers\Site\RegiserController;
use App\Http\Controllers\Site\ReveiwController;
use App\Http\Controllers\Site\ShopController;
use App\Http\Controllers\Site\ShopDetailsController;
use App\Http\Controllers\Site\WebSiteAuthController;
use App\Http\Middleware\Auth;
use App\Http\Middleware\Website;
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
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {
    Route::group(['prefix' => 'dashboard'], function () {
        Route::middleware(Auth::class)->group(function ()
        {
            Route::resource('main', MainController::class);
            Route::resource('admins', AdminController::class);
            Route::resource('stores-types', StoreTypeController::class);
            Route::resource('stores', StoreController::class);
            Route::resource('storesStatus', StoresStatusController::class);
            Route::resource('categories', CategoryController::class);
            Route::resource('coupons', CouponController::class);
            Route::resource('products', ProductController::class);
            Route::resource('attributes', AttributeController::class);
            Route::resource('sizes', SizeController::class);
            Route::resource('colors', ColorController::class);
            Route::resource('images', ImageController::class);
            Route::resource('carts', \App\Http\Controllers\Admin\CartController::class);
            Route::resource('reviewsDashboard', ReviewDashboardController::class);
            Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
        });
        Route::view('/login', 'Admin.auth.login')->name('loginPage');
        Route::view('/forgetPassword', 'Admin.auth.forget_password')->name('forgetPasswordPage');
        Route::get('/recoverPassword', [AuthController::class, 'recoverPasswordPage']);
        Route::post('/login/check', [AuthController::class, 'checkLogin'])->name('checkLogin');
        Route::Post('/forgetPassword/check', [AuthController::class, 'checkEmailorPhone'])->name('checkEmailorPhone');
        Route::post('/recoverPassword', [AuthController::class, 'recoverPassword'])->name('recoverPassword');

    });

    Route::group(['prefix' => 'MultiShop'], function () {
        Route::middleware(Website::class)->group(function ()
        {
            Route::resource('cart', CartController::class);
            Route::resource('checkout', CheckoutController::class);
            Route::resource('contact', ContactController::class);
            Route::resource('review', ReveiwController::class);
            Route::resource('shopDetails', ShopDetailsController::class);
            Route::resource('applyCoupon',ApplyCouponContoller::class);
            Route::get('/logout',[WebSiteAuthController::class,'logout'])->name('WebsiteLogout');
        });
        Route::resource('home', HomeSiteController::class);
        Route::resource('shop', ShopController::class);
        Route::resource('shopDetails', ShopDetailsController::class);
        Route::resource('customers', CustomerController::class);
        Route::controller(WebSiteAuthController::class)->group(function ()
        {
            Route::view('/login','Site.pages.auth.login')->name('WebsiteLoginPage');
            Route::view('/register','Site.pages.auth.register')->name('WebsiteRegisterPage');
            Route::post('/check','checkLogin')->name('WebsiteCheckLogin');
        });
    });






});
