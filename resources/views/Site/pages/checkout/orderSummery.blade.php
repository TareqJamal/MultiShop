<div class="d-flex justify-content-between mt-2">
    <h5>Total (Applied Coupon with value = % {{$value}})</h5>
    <h5 id="totalPrice">${{$subTotal - (($subTotal * $value) / 100)}}</h5>
</div>
