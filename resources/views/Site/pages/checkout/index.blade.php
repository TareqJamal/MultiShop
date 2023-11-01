@extends('Site.layout.index')
@section('title')
    Checkout
@endsection
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
</head>
@section('content')
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{route('home.index')}}">Home</a>
                    <a class="breadcrumb-item text-dark" href="{{route('shop.index')}}">Shop</a>
                    <span class="breadcrumb-item active">Checkout</span>
                </nav>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Billing Address</span>
                </h5>
                <form id="makeOrder" data-action="{{route('orders.store')}}" method="Post">
                    @csrf
                    <div class="bg-light p-30 mb-5">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Address Line 1</label>
                                <input class="form-control" name="addressLine_1" type="text" placeholder="123 Street">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Address Line 2</label>
                                <input class="form-control" name="addressLine_2" type="text" placeholder="123 Street">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Country</label>
                                <select class="custom-select" name="country">
                                    <option selected>United States</option>
                                    <option>Afghanistan</option>
                                    <option>Albania</option>
                                    <option>Algeria</option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>City</label>
                                <input class="form-control" name="city" type="text" placeholder="New York">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>State</label>
                                <input class="form-control" name="state" type="text" placeholder="New York">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>ZIP Code</label>
                                <input class="form-control" name="zipCode" type="text" placeholder="123">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Payment Method</label>
                                <select class="custom-select" name="paymentMethod" id="paymentMethodSelect">
                                    <option selected>Choose</option>
                                    <option value="cash">Cash</option>
                                    <option value="visa">Visa</option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group" id="cashDiv" style="display: none;">
                                <h4 style="margin-top: 35px">In case of cash payment, $15 will be paid </h4>
                            </div>
                            <input type="hidden" name="totalPrice" id="totalPriceInput" value="">
                            @if(isset($cart))
                                <input type="hidden" name="product_id" value="{{$cart->product_id}}">
                                <input type="hidden" name="quantity" value="{{$cart->productQuantity}}">
                            @elseif(isset($orderProducts))
                                @foreach($orderProducts as $orderProduct)
                                    <input type="hidden" name="product_ids[]" value="{{$orderProduct->product_id}}">
                                    <input type="hidden" name="productQuantities[]" value="{{$orderProduct->productQuantity}}">
                                @endforeach
                            @endif
                        </div>

                        <button id="bitPlaceOrder" class="btn btn-block btn-primary font-weight-bold py-3">Place Order</button>
                    </div>

                </form>
            </div>
            <div class="col-lg-4">
                @php
                    $supTotal = 0 ;
                @endphp
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Order Summery</span>
                </h5>
                <form id="applyCoupon" class="mb-30" method="Post" data-action="{{route('applyCoupon.store')}}">
                    @csrf
                    <div class="input-group">
                        <input type="text" class="form-control border-0 p-4" name="code" placeholder="Coupon Code">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Apply Coupon</button>
                        </div>
                        <input type="hidden" name="subTotal" id="subTotalInput" value="">
                    </div>
                </form>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom">
                        <h6 class="mb-3">Products</h6>
                        @if(isset($cart))
                            <div class="d-flex justify-content-between">
                                <p>{{$product->name}}</p>
                                <p>${{$cart->total}}</p>
                            </div>
                        @elseif(isset($orderProducts))
                            @foreach($orderProducts as $orderProduct)
                                <div class="d-flex justify-content-between">
                                    <p>{{$orderProduct->productName}}</p>
                                    <p>${{$orderProduct->total}}</p>
                                </div>
                                @php $supTotal += $orderProduct->total @endphp
                            @endforeach
                        @endif
                    </div>

                    <div class="border-bottom pt-3 pb-2 totalPrice">
                        @if(isset($cart))
                            <div class="d-flex justify-content-between mb-3">
                                <h6>Subtotal</h6>
                                <h6>${{$cart->total}}</h6>
                            </div>
                        @elseif(isset($orderProducts))
                            <div class="d-flex justify-content-between mb-3">
                                <h6>Subtotal</h6>
                                <h6>${{$supTotal}}</h6>
                            </div>
                        @endif
                    </div>
                    <div class="pt-2 applyCoupon">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="totalPrice">$ {{$cart->total ?? $supTotal}}</h5>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
<script>
    $(document).ready(function () {

        $('#paymentMethodSelect').on('change', function () {
            var selectedPaymentMethod = $(this).val();
            // Show the div corresponding to the selected payment method
            if (selectedPaymentMethod === 'cash') {
                $('#cashDiv').show();
                $('#bitPlaceOrder').text('PLace Order');
            } else if (selectedPaymentMethod === 'visa') {
                $('#bitPlaceOrder').text('Continue to Pay With Visa');
                $('#cashDiv').hide();
            }
        });

        $('#applyCoupon').on('submit', function (e) {
            var url = $(this).attr('data-action');
            e.preventDefault();
            var subTotal = $('#totalPrice').text().replace('$', ''); // Extract the numerical value
            $('#subTotalInput').val(subTotal);

            $.ajax({
                url: url,
                method: "POST",
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    if (response.success) {
                        Swal.fire(
                            response.success,
                            'Enjoy with Discount',
                            'success'
                        )
                        $('.applyCoupon').html(response.html)
                        applyCoupon.reset();
                    }
                    if (response.error) {
                        Swal.fire(
                            response.error,
                            'Try Another Code ',
                            'error'
                        )
                    }
                },
                error: function (response) {
                    toastr.warning('Something is wrong , Please Try Again')
                }
            })
        })
        $('#makeOrder').on('submit', function (e) {
            var url = $(this).attr('data-action');
            e.preventDefault();
            var totalPrice = $('#totalPrice').text().replace('$', ''); // Extract the numerical value
            $('#totalPriceInput').val(totalPrice);

            $.ajax({
                url: url,
                method: "POST",
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    if (response.success) {
                        Swal.fire(
                            response.success,
                            'Enjoy with Discount',
                            'success'
                        )
                        makeOrder.reset();
                    }
                    if (response.error) {
                        Swal.fire(
                            response.error,
                            'Try Another Code ',
                            'error'
                        )
                    }
                },
                error: function (response) {
                    toastr.warning('Something is wrong , Please Try Again')
                }
            })
        })

    });
</script>
