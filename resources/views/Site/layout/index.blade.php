<!DOCTYPE html>
<html lang="en">

<head>
    @include('Site.includes.meta')
    <title>MultiShop - @yield('title')</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include other CSS files as needed -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Include JavaScript links here -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


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
