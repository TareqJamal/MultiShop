<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | Recover Password</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('admin')}}/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('admin')}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('admin')}}/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    @include('Admin.Includes.css')
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="{{route('loginPage')}}"><b>DashBoard </b>Multi-Shop</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>
            <form id="recoverPasswordForm" data-action="{{route('recoverPassword')}}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" class="form-control" name="email" placeholder="Your Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="newPassword" placeholder="New Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control"  name="confirmPassword" placeholder="Confirm Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button id="btn" type="submit" class="btn btn-primary btn-block">Change Password</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

{{--            <p class="mt-3 mb-1">--}}
{{--                <a class="btn btn-danger href="{{route('loginPage')}}">Login</a>--}}
{{--            </p>--}}
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('admin')}}//plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('admin')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin')}}/dist/js/adminlte.min.js"></script>
@include('Admin.Includes.js')
<script>
    $(document).ready(function ()
    {
        $('#recoverPasswordForm').on('submit',function (e)
        {
            var url = $(this).attr('data-action');
            e.preventDefault();
            $.ajax({
                url : url,
                method : "POST",
                data : new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {
                    document.getElementById("btn").innerHTML = 'Changing...';
                },
                success: function(response)
                {
                    if(response.success)
                    {
                        toastr.success(response.success);
                        window.location.href = response.redirect;
                    }
                    if(response.error)
                    {
                        toastr.error(response.error);
                    }
                },
                error: function(response) {
                    console.log(response);
                }
            })
        })
    });
</script>
</body>
</html>
