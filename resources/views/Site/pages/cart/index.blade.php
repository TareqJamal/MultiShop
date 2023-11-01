@extends('Site.layout.index')
@section('title')
    Cart
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
                    <span class="breadcrumb-item active">Shopping Cart</span>
                </nav>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row px-xl-5 tableAndSummery">
            <div class="col-lg-8 table-responsive mb-5">
                <table id="carts" class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                    <tr>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Actions</th>
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
                                <a href="{{route('checkout.show',$cart->id)}}" class="btn btn-sm btn-success continueToCheckout">
                                    <i class="fa fa-check"> Continue to Checkout</i>
                                </a>
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
                        <a href="{{route('checkout.index')}}" class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed All Products To Checkout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

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



</script>
