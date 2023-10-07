<?php

namespace App\Http\Actions;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Store;

class MainAction
{
    public function counts()
    {
        $countProducts = Product::count();
        $countStores = Store::count();
        $countAdmin = Admin::count();
        $countCoupon = Coupon::count();
        $countCategory = Category::count();
        return [
            'countProducts'=>$countProducts,
            'countStores'=>$countStores,
            'countAdmin'=>$countAdmin,
            'countCoupon'=>$countCoupon,
            'countCategory'=>$countCategory,
        ];

    }

}
