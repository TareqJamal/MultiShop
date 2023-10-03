<?php

namespace App\Http\Actions;

use App\Models\Coupon;

class CouponAction
{
    public function storeCoupon($data)
    {
        return Coupon::create($data);
    }

    public function getCoupon($id)
    {
        return Coupon::findorfail($id);
    }

    public function updateCoupon($id, $data)
    {
        $coupon = $this->getCoupon($id);
        return $coupon->update($data);
    }

    public function statusCoupon($id)
    {
        $coupon = $this->getCoupon($id);
        return $coupon->update([
            'status' => !$coupon->status
        ]);
    }
    public function delete($id)
    {
        return Coupon::destroy($id);
    }

}
