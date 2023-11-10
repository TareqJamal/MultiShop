<?php

namespace App\Http\Controllers\Site;

use App\Enum\OrderTypes;
use App\Events\OrderNotification;
use App\Http\Actions\OrderAction;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderContoller extends Controller
{
    public $data = ['customer_id', 'addressLine_1', 'addressLine_2', 'country', 'city', 'state', 'totalPrice', 'zipCode', 'paymentMethod'];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
    public function store(Request $request, OrderAction $action)
    {
        $postedData = $request->only($this->data);
        $action->storeOrder($postedData, $request);
        return response()->json(['success' => 'Order Make Successfully']);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::findorfail($id);
        $order->status = OrderTypes::Canceled->value;
        $order->save();
        return redirect(route('home.index'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customer = Auth::guard('customer')->user();
        $order = Order::findorfail($id);
        $order->status = OrderTypes::Confirmed->value;
        $order->save();
        event(new OrderNotification($customer, $order));
        return redirect(route('initiatePayment', $id));
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
