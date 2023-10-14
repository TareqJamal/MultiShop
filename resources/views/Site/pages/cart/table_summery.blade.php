<div class="col-lg-8 table-responsive mb-5">
    <table id="carts" class="table table-light table-borderless table-hover text-center mb-0">
        <thead class="thead-dark">
        <tr>
            <th>Products</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Remove</th>
        </tr>
        </thead>
        <tbody class="align-middle">
        @if($carts->count() >= 1)
            @foreach($carts as $cart)
                <tr>
                    <td class="align-middle"><img src="{{asset('')}}{{$cart->productImage}}" alt=""
                                                  style="width: 50px;"> {{$cart->productName}}</td>
                    <td class="align-middle">{{$cart->productPrice}}</td>
                    <td class="align-middle">
                        {{$cart->productQuantity}}
                    </td>
                    <td class="align-middle">${{$cart->total}}  </td>
                    <td class="align-middle">
                        <button class="btn btn-sm btn-success DeleteCart" data-id="{{$cart->id}}">
                            <i class="fa fa-check"> Continue to Checkout</i>
                        </button>
                        <button class="btn btn-sm btn-danger DeleteCart" data-id="{{$cart->id}}">
                            <i class="fa fa-times"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td style="font-weight: bold">No Products in your Cart</td>
            </tr>
        @endif

        </tbody>
    </table>
</div>
<div class="col-lg-4">
    <form id="applyCoupon" class="mb-30" method="Post" data-action="{{route('applyCoupon.store')}}">
        @csrf
        <div class="input-group">
            <input type="text" class="form-control border-0 p-4" name="code" placeholder="Coupon Code">
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">Apply Coupon</button>
            </div>
        </div>
    </form>
    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span>
    </h5>
    <div class="bg-light p-30 mb-5 cartSummery">
        <div class="border-bottom pb-2">
            <div class="d-flex justify-content-between mb-3">
                <h6>Subtotal</h6>
                <h6>${{$subTotal}}</h6>
            </div>
        </div>
        <div class="pt-2">
            <div class="d-flex justify-content-between mt-2">
                <h5>Total</h5>
                <h5>{{$subTotal}}</h5>
            </div>
            <button class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout
            </button>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.DeleteCart').on('click', function () {
            var cartId = $(this).data('id');
            var url = "{{route('cart.destroy',':cartId')}}"
            url = url.replace(':cartId', cartId);
            $.ajax({
                url: url,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Add CSRF token
                },
                success: function (response) {
                    toastr.success(response.success);
                    $('.tableAndSummery').html(response.html);
                }
            })
        });
    });
    $(document).ready(function () {
        $('#applyCoupon').on('submit', function (e) {
            var url = $(this).attr('data-action');
            e.preventDefault();
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
                        $('.cartSummery').html(response.html)
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
