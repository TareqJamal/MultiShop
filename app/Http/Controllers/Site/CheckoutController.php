<?php

namespace App\Http\Controllers\Site;

use App\Http\Actions\CheckoutAction;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orderProducts = Cart::all()->where('customer_id', Auth::guard('customer')->user()->id);
        return view('Site.pages.checkout.index')->with(['orderProducts' => $orderProducts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, CheckoutAction $action)
    {
        $cart = $action->getCart($id);
        $product = Product::findorfail($cart->product_id);
        return view('Site.pages.checkout.index')->with(
            [
                'cart' => $cart,
                'product' => $product
            ]);


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
