<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{asset('admin')}}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('admin')}}/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                     alt="User Image">
            </div>
            <div class="info">
                @if(\Illuminate\Support\Facades\Session::has('statusAdmin'))
                    <a href="#" class="d-block">{{\Illuminate\Support\Facades\Auth::guard('admin')->user()->name}}</a>
                @elseif(\Illuminate\Support\Facades\Session::has('statusSuper'))
                    <a href="#" class="d-block">{{\Illuminate\Support\Facades\Auth::guard('web')->user()->name}}</a>
                @endif
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview menu-open">
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('main.index')}}" class="nav-link">
                                <i class="far fa-house-user nav-icon"></i>
                                <p>Main</p>
                            </a>
                        </li>
                        @if(!\Illuminate\Support\Facades\Auth::guard('admin')->check())
                            <li class="nav-item">
                                <a href="{{route('admins.index')}}" class="nav-link">
                                    <i class="fa fa-people-carry nav-icon"></i>
                                    <p>Admins</p>
                                </a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a href="{{route('customersDashboard.index')}}" class="nav-link">
                                <i class="far fa-user nav-icon"></i>
                                <p>Customers</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route("stores-types.index")}}" class="nav-link">
                                <i class="fa fa-warehouse nav-icon"></i>
                                <p>Stores Types</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route("stores.index")}}" class="nav-link">
                                <i class="fa fa-store nav-icon"></i>
                                <p>Stores </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route("storesStatus.index")}}" class="nav-link">
                                <i class="fa fa-shopping-basket nav-icon"></i>
                                <p>Stores Status </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route("categories.index")}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Categories </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route("coupons.index")}}" class="nav-link">
                                <i class="fa fa-percentage nav-icon"></i>
                                <p>Coupons </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route("products.index")}}" class="nav-link">

                                <i class="fa fa-shopping-bag nav-icon"></i>
                                <p>Products </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route("ordersDashboard.index")}}" class="nav-link">
                                <i class="fa fa-shopping-basket nav-icon"></i>
                                <p>Orders </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route("carts.index")}}" class="nav-link">

                                <i class="fa fa-cart-arrow-down nav-icon"></i>
                                <p>Carts </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route("reviewsDashboard.index")}}" class="nav-link">
                                <i class="far fa-comment nav-icon"></i>
                                <p>Reviews </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route("contactsDashboard.index")}}" class="nav-link">
                                <i class="fa fa-phone nav-icon"></i>
                                <p>Contacts </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('logout')}}" class="nav-link">
                                <i class="fa fa-arrow-right nav-icon"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
