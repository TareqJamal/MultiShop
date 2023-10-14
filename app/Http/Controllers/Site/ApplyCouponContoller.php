<?php

namespace App\Http\Controllers\Site;

use App\Http\Actions\ApplyCouponAction;
use App\Http\Actions\CartAction;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplyCouponContoller extends Controller
{
    public array $data = ['code'];
    public string $mainRoute = 'applyCoupon';
    public string $folderPath = 'Site.pages.cart.';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $getCoupon = Coupon::where('code', $request->code)->first();
        if ($getCoupon) {
            if ($getCoupon->status == 0) {
                $value = $getCoupon->percentage;
                $getCoupon->status = 1;
                $getCoupon->save();
                $subTotal = $action->getCarts(Auth::guard('customer')->user()->id);
                $returnHtml = view($this->folderPath . 'cartSummery')->with(['value' => $value, 'subTotal' => $subTotal['subTotal']])->render();
                return response()->json([
                    'html' => $returnHtml,
                    'success' => 'Coupon Applied Successfully',
                ]);
            } else {
                return response()->json(
                    ['error' => 'Sorry,The Coupon is Not Active Now']
                );
            }

        } else {
            return response()->json(
                ['error' => 'Sorry,The Code is Invaild']
            );
        }


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
    public function destroy(string $id)
    {
        //
    }
}
