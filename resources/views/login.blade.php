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

    <title>Jobolos | Login</title>
</head>

<body class="login-body">

    <div class="login-box container text-center d-flex">
        <div class="col col-lg-6 col-sm-12 m-4 p-3  ">
            <div class=" bg-form-login align-items-center p-4 rounded shadow">
                <div class="text-center mb-4">
                    <a href="/"><img src="/storage/frontend_assets/login-register/jobolos-logo-black.png"
                            witdh="150" height="150" alt="logo"></a>
                    <hr class="text-light">
                    <h4 class="bg-body-secondary rounded p-2">Hello, There!</h4>
                    {{-- <h4 class="mt-1 mb-5 pb-1">We are The Lotus Team</h4> --}}
                </div>

                <!-- Pills navs -->

                @if (Session::has('status'))
                    <div class="alert alert-danger login-alert " role="alert">
                        {{ Session::get('message') }}
                    </div>
                @else
                    <p class="text-light" style="font-size: 10pt;">Please login to your account to continue.
                    </p>
                @endif

                <!-- Pills content -->

                {{-- FORM LOGIN --}}
                <form action="" method="POST">
                    @csrf
                    <!-- Email input -->
                    <div class="mb-3">
                        <div class="input-group mb-1 mt-4">
                            <div class="form-floating mb-3">
                                <input type="email" name="email" class="form-control form-control-sm"
                                    id="floatingInput" value="{{ old('email') }}" placeholder="Email">
                                <label for="floatingInput">Email</label>
                                @if ($errors->has('email'))
                                    <p class="text-danger mt-1 error-input">{{ $errors->first('email') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="input-group mb-1">
                            <!-- Password input -->
                            <div class="form-floating ">
                                <input type="password" name="password" class="form-control" id="floatingPassword"
                                    placeholder="Password">
                                <label for="floatingPassword">Password</label>
                                @if ($errors->has('password'))
                                    <p class="text-danger mt-1 error-input">{{ $errors->first('password') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Remember Me Checkbox -->
                    <div class="form-check mb-3 text-start">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label text-light" for="remember">
                            Remember Me
                        </label>
                    </div>
                    {{-- <!-- 2 column grid layout -->
                            <div class="row mb-4">
                                <div class="col-md-6 d-flex justify-content-center">
                                    <!-- Checkbox -->
                                    <div class="form-check mb-3 mb-md-0 text-light">
                                        <input class="form-check-input" type="checkbox" value="" id="loginCheck"
                                            checked />
                                        <label class="form-check-label" for="loginCheck"> Remember me </label>
                                    </div>
                                </div>

                                <div class="col-md-6 d-flex justify-content-center forgot-pass">
                                    <!-- Simple link -->
                                    <a href="#!" class="text-light ">Forgot password?</a>
                                </div>
                            </div> --}}

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-block mb-3">Login</button>

                    <!-- Register buttons -->
                    <div class="text-center text-light to-register">
                        <p>Don't have an account? <a href="/register" class=" text-warning p-1">Register</a> Now
                        </p>
                    </div>
                </form>
            </div>
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
