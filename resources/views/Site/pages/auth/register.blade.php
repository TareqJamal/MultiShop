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
    <title>MultiShop | Register </title>
</head>
<body>


<div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('{{asset("site/auth")}}/images/bg_1.jpg');"></div>
    <div class="contents order-2 order-md-1">

        <div class="container">
            <div class="row align-items-center justify-content-center" STYLE="margin: 20px">
                <div class="row-cols-3">
                    <h3>Register to <strong>MultiShop</strong></h3>
                    <p class="mb-4">Lorem ipsum dolor sit amet elit. Sapiente sit aut eos consectetur adipisicing.</p>
                    <form id="registerForm" data-action="{{route('customers.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-2">
                            <div class="col-md-6 mb-3">
                                <label for="firstname">FirstName</label>
                                <input type="text" name="firstName" class="form-control" placeholder="Firstname" id="firstname" >
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lastname">LastName</label>
                                <input type="text" name="lastName" class="form-control" placeholder="Lastname" id="lastname" >
                            </div>
                            <br>
                            <div class="col-md-6 mb-3">
                                <label for="phone">Phone Number</label>
                                <input type="text" name="phone" class="form-control" placeholder="Phone Number" id="phone" >
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="address">Address</label>
                                <input type="text" name="address" class="form-control" placeholder="Address" id="address" >
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="image">Image</label>
                                <input type="file"  name="image" class="form-control" id="image" >
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Email" id="email" >
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Password" id="password" >
                            </div>
                            <div class="col-md-6">
                                <label for="confirmPassword">Confirm Password </label>
                                <input type="password" name="confirmPassword"  class="form-control" placeholder="Confirm Password" id="confirmPassword" >
                            </div>
                        </div>

                        <div class="d-flex mb-5 align-items-center">
                            <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                                <input type="checkbox" checked="checked"/>
                                <div class="control__indicator"></div>
                            </label>
                            <span class="ml-auto"><a href="#" class="forgot-pass">Forgot Password</a></span>
                        </div>

                        <input type="submit" id="btnregister" value="Register" class="btn btn-block btn-warning">
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
        $('#registerForm').on('submit', function (e) {
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
                    document.getElementById("btnregister").value = 'Registering...';
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
