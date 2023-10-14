<?php

namespace App\Http\Controllers\Site;

use App\Http\Actions\CartAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public string $folderPath = 'Site.pages.cart.';
    public array $data = ['customer_id', 'product_id', 'productName', 'productImage', 'productSize', 'productColor', 'productPrice', 'productQuantity', 'total'];
    public string $mainRoute = 'cart';

    /**
     * Display a listing of the resource.
     */
    public function index(CartAction $action)
    {
        $carts = $action->getCarts(Auth::guard('customer')->user()->id);
        return view('Site.pages.cart.index')->with(['carts' => $carts['carts'], 'subTotal' => $carts['subTotal']]);
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
    public function store(Request $request, CartAction $action)
    {
        $postedData = $request->only($this->data);
        $action->store($postedData);
        return redirect(route('cart.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function destroy(string $id, CartAction $action)
    {
        $action->deleteCart($id);
        $carts = $action->getCarts(Auth::guard('customer')->user()->id);
        $returnHtml = view($this->folderPath . 'table_summery')
            ->with(['carts' => $carts['carts'], 'subTotal' => $carts['subTotal']])->render();
        return response()->json([
            'success' => 'Cart Deleted Successfully',
            'html' => $returnHtml
        ]);
    }
}
