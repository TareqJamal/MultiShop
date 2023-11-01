<div class="border-bottom pb-2">
    <div class="d-flex justify-content-between mb-3">
        <h6>Subtotal</h6>
        <h6>${{$subTotal}}</h6>
    </div>
    <div class="d-flex justify-content-between mb-3">
        <h6>Coupon Applied</h6>
        <h6>%{{$value}}</h6>
    </div>
</div>
<div class="pt-2">
    <div class="d-flex justify-content-between mt-2">
        <h5>Total</h5>
        <h5>${{($subTotal - ($subTotal * $value)/100) }}</h5>
    </div>
    <button class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed All To Checkout</button>
</div>
