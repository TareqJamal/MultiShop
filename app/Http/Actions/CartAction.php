<?php

namespace App\Http\Actions;

use App\Models\Cart;

class CartAction
{
    public function store($data)
    {
        $data['total'] = $data['productPrice'] * $data['productQuantity'];
        return Cart::create($data);
    }

    public function getCarts($id)
    {
        $carts = Cart::all()->where('customer_id', $id);
        $supTotal = $carts->sum('total') ;
        return ['carts' => $carts, 'subTotal' => $supTotal];
    }
    public function deleteCart($id)
    {
        Cart::destroy($id);
    }


}
