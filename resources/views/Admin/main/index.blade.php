@extends('Admin.layout.index')
@section('title')
    Main
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{$products->count()}}</h3>
                    <p>Products</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="{{route('products.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-dark">
                <div class="inner">
                    <h3>{{$categories->count()}}</h3>
                    <p>Categories</p>
                </div>
                <div class="icon">
                    <i class="ion ion-star"></i>
                </div>
                <a href="{{route('categories.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$coupons}}</h3>
                    <p>Coupons</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{route('coupons.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{$admins}}</h3>
                    <p>Admins</p>
                </div>
                <div class="icon">
                    <i class="fa fa-people-carry nav-icon"></i>
                </div>
                <a href="{{route('admins.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{$stores}}</h3>
                    <p>Stores</p>
                </div>
                <div class="icon">
                    <i class="fa fa-store nav-icon"></i>
                </div>
                <a href="{{route('stores.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$carts}}</h3>
                    <p>Carts</p>
                </div>
                <div class="icon">
                    <i class="fa fa-cart-arrow-down nav-icon"></i>
                </div>
                <a href="{{route('carts.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-light">
                <div class="inner">
                    <h3>{{$customers}}</h3>

                    <p>Customers</p>
                </div>
                <div class="icon">
                    <i class="far fa-user nav-icon"></i>
                </div>
                <a href="{{route('customersDashboard.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3>{{$reviews}}</h3>
                    <p>Reviews</p>
                </div>
                <div class="icon">
                    <i class="far fa-comment nav-icon"></i>
                </div>
                <a href="{{route('reviewsDashboard.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$contacts}}</h3>

                    <p>Contacts</p>
                </div>
                <div class="icon">
                    <i class="fa fa-phone nav-icon"></i>
                </div>
                <a href="{{route('contactsDashboard.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
@endsection
{{----}}
