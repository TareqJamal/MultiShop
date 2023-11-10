<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Nafezly\Payments\Classes\PaymobPayment;

class PaymentController extends Controller
{
    public function initiatePayment($id)
    {
        $payment = new PaymobPayment();
        $order = Order::findorfail($id);
        $user = Auth::guard('customer')->user();
        $response = $payment->pay(
            $order->totalPrice,
            $user_id = $user->id,
            $user_first_name = $user->firstName,
            $user_last_name = $user->lastName,
            $user_email = $user->email,
            $user_phone = $user->phone,
            $source = null
        );
        $order->payment_id = $response['payment_id'];
        $order->save();
        $redirectUrl = $response['redirect_url'];
        return redirect($redirectUrl);
    }

    public function callBack(Request $request)
    {
        $order = Order::where('payment_id',$request->order)->first();
        $paymob = new PaymobPayment();
        $paymentData = $paymob->verify($request);
        $status = $paymentData['success'];
        if ($status == false) {
            $order->is_paid = 1;
            $order->save();
            return redirect(route('paymentStatus'));
        }

    }
}
