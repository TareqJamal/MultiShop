@extends('Site.layout.index')
@section('title')
    Shop
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{route('home.index')}}">Home</a>
                    <a class="breadcrumb-item text-dark" href="{{route('shop.index')}}">Shop</a>
                    <span class="breadcrumb-item active">Shop List</span>
                </nav>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Color Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by color</span>
                </h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-1" value="black">
                            <label class="custom-control-label" for="color-1">Black</label>
                        </div>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-2" value="white">
                            <label class="custom-control-label" for="color-2">White</label>
                        </div>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-3" value="red">
                            <label class="custom-control-label" for="color-3">Red</label>
                        </div>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-4" value="blue">
                            <label class="custom-control-label" for="color-4">Blue</label>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="checkbox" class="custom-control-input" id="color-5" value="green">
                            <label class="custom-control-label" for="color-5">Green</label>
                        </div>
                    </form>
                </div>
                <!-- Color End -->

                <!-- Size Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by size (Clothes)</span>
                </h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-1" value="xxl">
                            <label class="custom-control-label" for="size-1">XXL</label>
                        </div>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-2" value="s">
                            <label class="custom-control-label" for="size-2">S</label>
                        </div>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-3" value="m">
                            <label class="custom-control-label" for="size-3">M</label>
                        </div>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-4" value="l">
                            <label class="custom-control-label" for="size-4">L</label>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="checkbox" class="custom-control-input" id="size-5" value="xl">
                            <label class="custom-control-label" for="size-5">XL</label>
                        </div>
                    </form>
                </div>
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by size (Shoes)</span>
                </h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-28"  value="28">
                            <label class="custom-control-label" for="size-28"  >28</label>
                        </div>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-30"  value="30">
                            <label class="custom-control-label" for="size-30">30</label>
                        </div>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-32" value="32">
                            <label class="custom-control-label" for="size-32">32</label>
                        </div>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input"  id="size-34" value="34">
                            <label class="custom-control-label" for="size-34">34</label>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="checkbox" class="custom-control-input" id="size-36" value="36">
                            <label class="custom-control-label" for="size-36">36</label>
                        </div>
                    </form>
                </div>
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8" >
                <div class="row pb-3" id="filterProducts">
                    @if(isset($products))
                            @foreach($products as $product)
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img width="400px" height="400px" src="{{asset('')}}{{$product->image}}"
                                                 alt="">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href=""><i
                                                        class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href=""><i
                                                        class="far fa-heart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href=""><i
                                                        class="fa fa-sync-alt"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href=""><i
                                                        class="fa fa-search"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate"
                                               href="">{{$product->name}}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>${{$product->priceAfterDiscount}}</h5>
                                                <h6 class="text-muted ml-2">
                                                    <del>${{$product->price}}</del>
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
                            @endforeach
                    @endif
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
@endsection
<script src="{{asset('admin')}}/plugins/jquery/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('input[type="checkbox"]').on('change', function () {
            var value = $(this).val();
            $.ajax({
                url: "{{route('filter.store')}}",
                method: 'POST',
                data: {
                    value: value
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include the CSRF token
                },
                success: function (response) {
                    $('#filterProducts').html(response.html);
                }
            });

        });
    });
    //
    // $(document).ready(function () {
    //     $('input[type="checkbox"]').on('change', function () {
    //         alert('d');
    //         // var selectedColor = $(this).attr('id').replace('color-', '');
    //
    //         // $.ajax({
    //         //     url: '/filter-products-by-color',
    //         //     method: 'POST',
    //         //     data: {
    //         //         color: selectedColor
    //         //     },
    //         //     success: function (response) {
    //         //         // Replace the product list with the filtered products
    //         //         $('#product-list').html(response);
    //         //     }
    //         // });
    //     });
    // });
</script>
