<!DOCTYPE html>
<html lang="en">

<head>
    @include('Site.includes.meta')
    <title>MultiShop - @yield('title')</title>

    <!-- Favicon -->
    @include('Site.includes.css')
</head>

<body>
<!-- Topbar Start -->

<!-- Topbar End -->

@include('Site.layout.header')
<!-- Navbar Start -->

<!-- Navbar End -->


@yield('content')


<!-- Footer Start -->
@include('Site.layout.footer')
<!-- Footer End -->


<!-- Back to Top -->
@include('Site.includes.js')
</body>

</html>
