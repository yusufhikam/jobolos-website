<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('/') }}plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('/') }}plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('/') }}plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('/') }}plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/') }}dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('/') }}plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('/') }}plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('/') }}plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}fontawesome6/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.1/mdb.min.css" rel="stylesheet" /> --}}

    <link rel="stylesheet" href="{{ asset('css/frontend-login-register.css') }}">

    <title>Jobolos | Register</title>
</head>

<body class="register-body">

    <div class="register-box  container-fluid text-center d-flex">
        <div class="col col-lg-6 col-sm-12 m-4 p-3  ">
            <div class="bg-form-register align-items-center p-4 rounded shadow">
                <div class="text-center mb-4">
                    <a href="#"><img src="/storage/frontend_assets/login-register/jobolos-logo-black.png"
                            witdh="150" height="150" alt="logo"></a>
                    <hr class="text-light">
                    <h4 class="bg-body-secondary rounded p-2">Hello, There.<br> Let's Sign Up!</h4>
                </div>

                @if (Session::has('status'))
                    <div class="alert alert-success login-alert " role="alert">
                        {{ Session::get('message') }}
                    </div>
                @else
                    <p class="text-light" style="font-size: 10pt;">Please create your account to continue logging in.
                    </p>
                @endif

                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="container-fluid mb-3">
                        <div class="input-group mb-1 mt-4">
                            <div class="form-floating mb-1">
                                <input type="text" name="name" class="form-control form-control-sm"
                                    id="floatingName" value="{{ old('name') }}" placeholder="Name">
                                <label for="floatingName">Name</label>
                                @if ($errors->has('name'))
                                    <p class="text-danger m-1 error-input">{{ $errors->first('name') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="input-group mb-1">
                            <div class="form-floating mb-1">
                                <input type="email" name="email" class="form-control form-control-sm"
                                    id="floatingEmail" placeholder="Email" value="{{ old('email') }}">
                                <label for="floatingEmail">Email</label>
                                @if ($errors->has('email'))
                                    <p class="text-danger m-1 error-input">{{ $errors->first('email') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="input-group mb-1">
                            <div class="form-floating mb-1">
                                <input type="text" name="no_telp" class="form-control form-control-sm"
                                    id="floatingNoTelp" placeholder="WhatsApp Number" value="{{ old('no_telp') }}">
                                <label for="floatingNoTelp">WhatsApp Number</label>
                                @if ($errors->has('no_telp'))
                                    <p class="text-danger m-1 error-input">{{ $errors->first('no_telp') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="input-group mb-1">
                            <div class="form-floating mb-1">
                                <textarea name="alamat" id="floatingAlamat" cols="30" class="form-control" rows="2" placeholder="Address">{{ old('alamat') }}</textarea>
                                <label for="floatingAlamat">Address</label>
                                @if ($errors->has('alamat'))
                                    <p class="text-danger m-1 error-input">{{ $errors->first('alamat') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="row g-1">
                            <div class="col-md">
                                <div class="input-group">
                                    <div class="form-floating mb-1">
                                        <input type="password" name="password" class="form-control"
                                            id="floatingPassword" placeholder="Password">
                                        <label for="floatingPassword">Password</label>
                                        @if ($errors->has('password'))
                                            <p class="text-danger m-1 error-input">{{ $errors->first('password') }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="input-group">
                                    <div class="form-floating mb-3">
                                        <input type="password" name="password_confirmation" class="form-control"
                                            id="floatingPasswordConfirmation" placeholder="Confirm Password">
                                        <label for="floatingPasswordConfirmation">Confirm Password</label>
                                        @if ($errors->has('password_confirmation'))
                                            <p class="text-danger m-1 error-input">
                                                {{ $errors->first('password_confirmation') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block mb-3">Register</button>
                        <div class="text-center text-light to-register">
                            <p>Already have an account? <a href="/login" class="text-warning p-1">Login</a> Now!</p>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>



    <!-- jQuery -->
    <script src="{{ asset('/') }}plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('/') }}plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('/') }}plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="{{ asset('/') }}plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="{{ asset('/') }}plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="{{ asset('/') }}plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="{{ asset('/') }}plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('/') }}plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('/') }}plugins/moment/moment.min.js"></script>
    <script src="{{ asset('/') }}plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('/') }}plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="{{ asset('/') }}plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('/') }}plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('/') }}dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('/') }}dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('/') }}dist/js/pages/dashboard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    {{-- <script src="sweetalert2.all.min.js"></script> --}}

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

    {{-- CK Editor --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

    <!-- MDB -->
    {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.1/mdb.umd.min.js"></script> --}}
</body>

</html>
