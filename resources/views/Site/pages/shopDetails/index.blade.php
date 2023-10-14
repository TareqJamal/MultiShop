@extends('Site.layout.index')
@section('title')
    Shop Details
@endsection
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
@section('content')
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{route('home.index')}}">Home</a>
                    <a class="breadcrumb-item text-dark" href="{{route('shop.index')}}">Shop</a>
                    <span class="breadcrumb-item active">Shop Detail</span>
                </nav>
            </div>
        </div>
    </div>
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        @foreach($images as $key=>$image)
                            <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                <img class="w-100 h-100" src="{{asset('')}}{{$image->image}}" alt="Image">
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3>{{$product->name}}</h3>
                    <div class="d-flex mb-3">
                        <div class="text-primary mr-2">
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star-half-alt"></small>
                            <small class="far fa-star"></small>e
                        </div>
                        <small class="pt-1">(99 Reviews)</small>
                    </div>
                    <h3 class="font-weight-semi-bold mb-4">${{$product->price}}</h3>
                    <p class="mb-4">{{$product->description}}</p>
                   <form method="Post" action="{{route('cart.store')}}">
                       @csrf
                       <input type="hidden" name="product_id" value="{{$product->id ?? ''}}">
                       <input type="hidden" name="productName" value="{{$product->name ?? ''}}">
                       <input type="hidden" name="productPrice" value="{{$product->price ?? ''}}">
                       <input type="hidden" name="productImage" value="{{$product->image ?? ''}}">
                       <input type="hidden" name="customer_id" value="{{\Illuminate\Support\Facades\Auth::guard('customer')->user()->id ?? ''}}">
                       <div class="d-flex mb-3">
                           <strong class="text-dark mr-3">
                               Sizes:
                           </strong>
                           @foreach($sizes as $size)
                               <div class="custom-control custom-radio custom-control-inline">
                                   <input type="radio" class="custom-control-input" id="size-{{$size->id}}"
                                          name="productSize" value="{{$size->name}}">
                                   <label class="custom-control-label" for="size-{{$size->id}}">{{$size->name}}</label>
                               </div>
                           @endforeach
                       </div>
                       <div class="d-flex mb-4">
                           <strong class="text-dark mr-3">
                               Colors:
                           </strong>
                           @foreach($colors as $color)
                               <div class="custom-control custom-radio custom-control-inline">
                                   <input type="radio" class="custom-control-input" id="color-{{$color->id}}"
                                          name="productColor"  value="{{$color->name}}">
                                   <label class="custom-control-label"
                                          for="color-{{$color->id}}">{{$color->name}}</label>
                               </div>
                           @endforeach
                       </div>
                       <div class="d-flex align-items-center mb-4 pt-2">
                           <div class="input-group quantity mr-3" style="width: 130px;">
                               <input type="number" class="form-control bg-secondary border-0 text-center" name="productQuantity" value="1">

                           </div>
                           <button type="submit" class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Add To
                               Cart
                           </button>
                       </div>
                   </form>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30">
                    <div class="nav nav-tabs mb-4">
                        <a class="nav-item nav-link text-dark active" data-toggle="tab"
                           href="#tab-pane-1">Description</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-2">Information</a>
                        <a class="nav-item nav-link text-dark numberReviews" data-toggle="tab" href="#tab-pane-3">Reviews
                            ({{count($product->reviews)}})</a>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-pane-1">
                            <h4 class="mb-3">Product Description</h4>
                            <p>{{$product->description}}</p>
                        </div>
                        <div class="tab-pane fade" id="tab-pane-2">
                            <h4 class="mb-3">Additional Information</h4>
                            <p>Eos no lorem eirmod diam diam, eos elitr et gubergren diam sea. Consetetur vero aliquyam
                                invidunt duo dolores et duo sit. Vero diam ea vero et dolore rebum, dolor rebum eirmod
                                consetetur invidunt sed sed et, lorem duo et eos elitr, sadipscing kasd ipsum rebum
                                diam. Dolore diam stet rebum sed tempor kasd eirmod. Takimata kasd ipsum accusam
                                sadipscing, eos dolores sit no ut diam consetetur duo justo est, sit sanctus diam tempor
                                aliquyam eirmod nonumy rebum dolor accusam, ipsum kasd eos consetetur at sit rebum, diam
                                kasd invidunt tempor lorem, ipsum lorem elitr sanctus eirmod takimata dolor ea
                                invidunt.</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0">
                                            Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Duo amet accusam eirmod nonumy stet et et stet eirmod.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0">
                                            Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Duo amet accusam eirmod nonumy stet et et stet eirmod.
                                        </li>
                                        <li class="list-group-item px-0">
                                            Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-pane-3">
                            <div class="row">
                                <div class="col-md-6 review">
                                    <h4 class="mb-4"> Reviews for "{{$product->name}}"</h4>
                                    @foreach($reviews as $review)
                                        <div class="media mb-4">
                                            <img src="{{asset('')}}{{$review->customers->image}}" alt="Image"
                                                 class="img-fluid mr-3 mt-1" style="width: 45px;">
                                            <div class="media-body">
                                                <h6>{{$review->customers->firstName}} {{$review->customers->lastName}}
                                                    <small> - <i>{{$review->created_at->format('Y-m-d')}}</i></small>
                                                </h6>
                                                <div class="text-primary mb-2">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star-half-alt"></i>
                                                    <i class="far fa-star"></i>
                                                </div>
                                                <p>{{$review->message}}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="col-md-6">
                                    <h4 class="mb-4">Leave a review</h4>
                                    <form id="formReveiw" data-action="{{route('review.store')}}" method="Post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="message">Your Review *</label>
                                            <textarea id="message" name="message" cols="30" rows="5"
                                                      class="form-control"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Your Name *</label>
                                            <input type="text" name="name" class="form-control" id="name">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Your Email *</label>
                                            <input type="email" name="email" class="form-control" id="email">
                                        </div>
                                        <input hidden name="product_id" value="{{$product->id ?? ''}}">
                                        <input hidden name="customer_id"
                                               value="{{\Illuminate\Support\Facades\Auth::guard('customer')->user()->id ?? ''}}">
                                        <div class="form-group mb-0">
                                            <input type="submit" value="Leave Your Review" class="btn btn-primary px-3">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also Like</span>
        </h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    <div class="product-item bg-light">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="{{asset('site')}}/img/product-1.jpg" alt="">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=""><i
                                        class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="">Product Name Goes Here</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>$123.00</h5>
                                <h6 class="text-muted ml-2">
                                    <del>$123.00</del>
                                </h6>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small>(99)</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="{{asset('admin')}}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('admin')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 -->
<script src="{{asset('admin')}}/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="{{asset('admin')}}/plugins/toastr/toastr.min.js"></script>
<script>
    $(document).ready(function () {
        $('#formReveiw').on('submit', function (e) {
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
                    Swal.fire(
                        response.success,
                        'Enjoy With The Store',
                        'success'
                    )
                    $('.review').html(response.html);
                    $('.numberReviews').html('Reviews ' + response.numberReviews)
                    formReveiw.reset();
                },
                error: function (response) {
                    toastr.warning('Something is wrong , Please Try Again')
                }
            })


        })

    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get the increase and decrease buttons
        var plusButton = document.querySelector('.btn-plus');
        var minusButton = document.querySelector('.btn-minus');
        // Get the quantity input field
        var quantityInput = document.querySelector('[name="product_quantity"]');

        // Increase the quantity when clicking the plus button
        plusButton.addEventListener('click', function (e) {
            e.preventDefault();
            var currentValue = parseInt(quantityInput.value) || 0;
            quantityInput.value = currentValue + 1;
        });

        // Decrease the quantity when clicking the minus button
        minusButton.addEventListener('click', function (e) {
            e.preventDefault();
            var currentValue = parseInt(quantityInput.value) || 0;
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
            }
        });
    });
</script>


