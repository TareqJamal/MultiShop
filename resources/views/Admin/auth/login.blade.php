<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | Log in</title>
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
    <link rel="stylesheet" href="{{asset('admin')}}/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{asset('admin')}}/plugins/toastr/toastr.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('admin')}}/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
{{--    @include('Admin.Includes.css')--}}
</head>

<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="../../index2.html"><b>Admin</b>LTE</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>
            <form id="formLogin" data-action="{{route('checkLogin')}}" method="Post">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="Email" name="email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                        <select class="form-control" name="role">
                            <option value="admin">Choose</option>
                            @foreach(\App\Enum\UserTypes::cases() as $case)
                            <option value="{{$case->value}}">{{$case->value}}</option>
                            @endforeach
                        </select>
                </div>

                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" name="password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <!-- /.social-auth-links -->
            <p class="mb-1">
                <a href="forgot-password.html">I forgot my password</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('admin')}}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('admin')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin')}}/dist/js/adminlte.min.js"></script>
<script src="{{asset('admin')}}/plugins/jquery/jquery.min.js"></script>
{{--@include('Admin.Includes.js')--}}
<script>
    $(document).ready(function ()
    {
        $('#formLogin').on('submit',function (e)
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
                success: function(response)
                {
                    toastr.success('done');
                    // if(response.message)
                    // {
                    //     toastr.error(response.message)
                    // }
                    // if(response.success)
                    // {
                    //     toastr.success('done');
                    //   //  window.location.href = response.redirect

                    }
                },
                error: function(response) {
                    toastr.warning('Something is wrong , Please Try Again')
                }
            })


        })

    });
</script>
</body>
</html>
