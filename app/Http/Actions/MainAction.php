<?php

namespace App\Http\Actions;

use App\Models\Admin;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Coupon;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Review;
use App\Models\Store;

class MainAction
{
    public function counts()
    {
        $countProducts = Product::all()->count();
        $countStores = Store::count();
        $countAdmin = Admin::count();
        $countCoupon = Coupon::count();
        $countCategory = Category::count();
        $countCarts = Cart::count();
        $countCustomers = Customer::count();
        $countReviews = Review::count();
        $countContacts = Contact::count();
        return [
            'countProducts' => $countProducts,
            'countStores' => $countStores,
            'countAdmin' => $countAdmin,
            'countCoupon' => $countCoupon,
            'countCategory' => $countCategory,
            'countCarts' => $countCarts,
            'countCustomers' => $countCustomers,
            'countReviews' => $countReviews,
            'countContacts' => $countContacts,
        ];

    }

}
