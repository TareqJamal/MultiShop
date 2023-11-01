<?php

namespace App\Http\Actions;

use App\Mail\ConfirmOrder;
use App\Mail\RecoverPasswordEmail;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderAction
{

    public function storeOrder($data, $request)
    {
        if ($request->input('product_id')) {
            $this->storeOneProduct($request , $data);
        }

        if ($request->input('product_ids')) {
            $this->storeMultipleProduct($request , $data);
        }

    }

    public function storeOneProduct(Request $request , $data): void
    {
            $customer = Auth::guard('customer')->user();
            $data['customer_id'] = $customer->id;
            $order = Order::create($data);
            OrderDetails::create([
                'order_id' => $order->id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity
            ]);
            $productIDS = OrderDetails::where('order_id', $order->id)->pluck('product_id')->toArray();
            $products = Product::whereIn('id', $productIDS)->get();
            Cart::where('customer_id', $customer->id)->whereIn('product_id', $productIDS)->delete();
            Mail::to($customer->email)->send(new ConfirmOrder($customer, $order, $products));
    }

    public function storeMultipleProduct(Request $request , $data): void
    {
        $products_IDS = $request->product_ids;
        $productQuantities = $request->productQuantities;
        $customer = Auth::guard('customer')->user();
        $data['customer_id'] = $customer->id;
        $order = Order::create($data);
        foreach ($products_IDS as $key => $product_ID) {
            OrderDetails::create([
                'order_id' => $order->id,
                'product_id' => $product_ID,
                'quantity' => $productQuantities[$key]
            ]);
        }
        $products = Product::whereIn('id', $products_IDS)->get();
        $cartProducts = Cart::all()->where('customer_id', $customer->id);
        foreach ($cartProducts as $cartProduct) {
            $cartProduct->delete();
        }
        Mail::to($customer->email)->send(new ConfirmOrder($customer, $order, $products));
    }
}
