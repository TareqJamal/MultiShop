<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $categories = Category::all();
            $products = Product::all();
            if (Auth::guard('customer')->check()) {
                $cartNumber = Cart::all()->where('customer_id', Auth::guard('customer')->user()->id)->count();
                $view->with([
                    'categories' => $categories,
                    'products' => $products,
                    'cartNumber' => $cartNumber
                ]);
            } else {
                $view->with([
                    'categories' => $categories,
                    'products' => $products,

                ]);
            }


        });
    }
}
