<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{asset("site/auth")}}/fonts/icomoon/style.css">

    <link rel="stylesheet" href="{{asset("site/auth")}}/css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset("site/auth")}}/css/bootstrap.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="{{asset("site/auth")}}/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="{{asset('admin')}}/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{asset('admin')}}/plugins/toastr/toastr.min.css">

    <title>MultiShop | Login </title>
</head>
<body>


<div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('{{asset("site/auth")}}/images/bg_1.jpg');"></div>
    <div class="contents order-2 order-md-1">

        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-7">
                    <h3>Login to <strong>MultiShop</strong></h3>
                    <p class="mb-4">Lorem ipsum dolor sit amet elit. Sapiente sit aut eos consectetur adipisicing.</p>
                    <form id="loginForm" data-action="{{route('WebsiteCheckLogin')}}" method="post">
                        @csrf
                        <div class="form-group first">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="email" placeholder="your-email@gmail.com" id="username">
                        </div>
                        <div class="form-group last mb-3">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Your Password" id="password">
                        </div>

                        <div class="d-flex mb-5 align-items-center">
                            <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                                <input type="checkbox" checked="checked"/>
                                <div class="control__indicator"></div>
                            </label>
                            <span class="ml-auto"><a href="{{route('WebsiteRegisterPage')}}" class="forgot-pass">Register Now !</a></span>
                            <span class="ml-auto"><a href="#" class="forgot-pass">Forgot Password</a></span>
                        </div>

                        <input type="submit" id="btnlogin" value="Log In" class="btn btn-block btn-warning">

                    </form>
                </div>
            </div>
        </div>
    </div>


</div>



<script src="{{asset("site/auth")}}/js/jquery-3.3.1.min.js"></script>
<script src="{{asset("site/auth")}}/js/popper.min.js"></script>
<script src="{{asset("site/auth")}}/js/bootstrap.min.js"></script>
<script src="{{asset("site/auth")}}/js/main.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{asset('admin')}}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('admin')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 -->
<script src="{{asset('admin')}}/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="{{asset('admin')}}/plugins/toastr/toastr.min.js"></script>
<script>

    $(document).ready(function () {
        $('#loginForm').on('submit', function (e) {
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
                beforeSend: function ()
                {
                    document.getElementById("btnlogin").value = 'Logging...';
                },
                success: function (response) {
                    if(response.success) {
                        toastr.success(response.success)
                        window.location.href = response.redirect;
                    }
                    if(response.error) {
                        toastr.error(response.error)

                    }

                },
                error: function (response) {
                    toastr.warning('Something is wrong , Please Try Again')
                }
            })


        })

    });
</script>
</body>
</html>
