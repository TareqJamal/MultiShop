<?php

namespace App\Http\Actions;

use App\Models\Cart;
use App\Models\Order;

class CheckoutAction
{
    public function getCart($id)
    {
        return Cart::findorfail($id);
    }
    public function getOrders($id)
    {
        $orders = Cart::all()->where('customer_id', $id);
    }

}
