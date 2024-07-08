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
    {{-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> --}}
    <!-- Tempusdominus Bootstrap 4 -->
    {{-- <link rel="stylesheet"
        href="{{ asset('/') }}plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css"> --}}
    <!-- iCheck -->
    {{-- <link rel="stylesheet" href="{{ asset('/') }}plugins/icheck-bootstrap/icheck-bootstrap.min.css"> --}}
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('/') }}plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/') }}dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('/') }}plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    {{-- <link rel="stylesheet" href="{{ asset('/') }}plugins/daterangepicker/daterangepicker.css"> --}}
    <!-- summernote -->
    {{-- <link rel="stylesheet" href="{{ asset('/') }}plugins/summernote/summernote-bs4.min.css"> --}}
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

    {{-- google icon --}}
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    {{-- FULL CALENDAR JAVASCRIPT --}}
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.14/index.global.min.js'></script>

    <link rel="stylesheet" href="{{ asset('css/frontend_style.css') }}">

    <title>@yield('title')</title>
</head>

<body>

    <div class="loader">
        <div class="custom-loader"></div>
    </div>
    <header class="header-navbar nav-scroll">
        <!-- Navigation-->
        {{-- <a href="" class="logo navbar-brand">
            <img class="d-inline-block align-text-top" src="/storage/frontend_assets/brand-logo/jobolos-logo-2.png"
                alt="brand-logo">
        </a> --}}
        <a class="navbar-brand logo nav-brand" href="/">
            <img src="/storage/frontend_assets/brand-logo/jobolos-logo-black-wide.png" alt="Jobolos Photography">
        </a>

        <input type="checkbox" name="" id="check">

        <label for="check" class="icons">
            <i class="fa fa-solid fa-bars" id="menu-icon"></i>
            <i class="fa fa-solid fa-xmark" id="close-icon"></i>
        </label>

        <nav id="navbars" class="navbars nav-scroll-2">
            <a href="/"style="--i:0;" class="{{ Request::is('/') ? 'active' : '' }}">Home</a>

            <div class="dropdowns" style="--i:2;">
                <a href="/jobolos/stories"
                    class="dropbtn {{ Request::is('jobolos/stories') || Request::is('jobolos/album/') ? 'active' : '' }}">Stories
                    <i class="fa fa-solid fa-caret-down"></i></a>
                <ul class="dropdown-contents">
                    @foreach ($categories as $ctg)
                        <li>
                            <a href="/jobolos/gallery-{{ $ctg->id }}/{{ $ctg->name }}">{{ $ctg->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <a href="/jobolos/about"style="--i:1;" class="{{ Request::is('jobolos/about') ? 'active' : '' }}">About
                Us</a>

            <div class="dropdowns" style="--i:3;">
                <a href="/jobolos/contact"
                    class="dropbtn {{ Request::is('jobolos/contact') || Request::is('jobolos/contact/photoshoot-booking') || Request::is('jobolos/rental-camera-booking/{id}/{name}') ? 'active' : '' }}">Contact
                    <i class="fa fa-solid fa-caret-down"></i></a>
                <ul class="dropdown-contents">
                    <li><a href="/jobolos/contact/photoshoot-booking"
                            class="{{ Request::is('jobolos/contact/photoshoot-booking') ? 'active' : '' }}">Book
                            a
                            Photoshoot</a></li>
                    <li><a href="/jobolos/package-info/camera-info"
                            class="{{ Request::is('jobolos/rental-camera-booking/{id}/{name}') ? 'active' : '' }}">Rent
                            a Camera</a>
                    </li>
                </ul>
            </div>
            <div class="dropdowns" style="--i:4;">
                <a href="/jobolos/package-info"
                    class="dropbtn {{ Request::is('jobolos/package-info') || Request::is('jobolos/package-info/camera-info') || Request::is('jobolos/package-info/photoshoot-packages') ? 'active' : '' }}">Package
                    <i class="fa fa-solid fa-caret-down"></i></a>
                <ul class="dropdown-contents">
                    <li><a href="/jobolos/package-info/photoshoot-packages"
                            class="{{ Request::is('jobolos/package-info/photoshoot-packages') ? 'active' : '' }}">Photoshoot</a>
                    </li>
                    <li><a href="/jobolos/package-info/camera-info"
                            class="{{ Request::is('jobolos/package-info/camera-info') ? 'active' : '' }}">Camera
                            Rental</a></li>

                </ul>
            </div>
            {{-- auth untuk pengecekan apakah pengguna sudah login atau belum
                cara ini lebih bersih penulisannya daripada 'Auth::check()'
                --}}
            @auth
                <div class="dropdowns" style="--i:5;">
                    <a href="#"
                        class="dropbtn {{ Request::is('jobolos/transactions') || Request::is('jobolos/rental-transactions') ? 'active' : '' }}">Transactions
                        <i class="fa fa-solid fa-caret-down"></i></a>

                    <ul class="dropdown-contents">
                        <li><a href="/jobolos/transactions"
                                class="{{ Request::is('jobolos/transactions') ? 'active' : '' }}">Photoshoot
                                Transaction</a>
                        </li>
                        <li><a href="/jobolos/rental-transactions"
                                class="{{ Request::is('jobolos/rental-transactions') ? 'active' : '' }}">Camera
                                Rental Transactions</a></li>

                    </ul>

                    {{-- <a class="dropbtn{{ Request::is('jobolos/transactions') ? 'active' : '' }}"
                        href="/jobolos/transactions" style="--i:5;">Transactions <span
                            class=" badge rounded-pill bg-danger">
                            99+
                            <span class="visually-hidden">unread messages</span>
                        </span></a> --}}
                </div>
            @endauth

            @auth
                <div class="dropdowns">
                    <a href="#" style="--i:6;" class="btn btn-login">
                        @if (Auth::user()->image != null)
                            <img class="img-circle"
                                src="{{ asset('storage/admin_assets/images_users/' . Auth::user()->image) }}"
                                alt="foto_user" width="25px" height="25px">
                        @else
                            <img src="{{ asset('storage/users/images/pp.png') }}" alt="foto_user" class="img-rounded"
                                width="25px" height="25px">
                        @endif
                    </a>
                    <ul class="dropdown-contents">
                        <li><a href="/logout" class="btn-login text-center">Logout</a></li>
                    </ul>
                </div>
            @else
                <a href="/login" style="--i:6;" class="btn btn-success text-light">Login</a>
            @endauth


        </nav>
    </header>


    <!-- Carousel -->
    {{-- @include('layouts.frontend.carouselLayout') --}}
    {{-- End Carousel --}}

    {{-- Content --}}
    {{-- <section style="margin-top: 4.3rem;"> --}}
    @yield('content')
    {{-- </section> --}}
    @include('sweetalert::alert')

    {{-- End Content --}}


    <a href="#" class="btn btn-success back-to-top"><i class="fa-solid fa-chevron-up"></i></a>
    <footer class="footer bg-black small text-center text-white-50">
        <div class="container px-4 px-lg-5">Copyright &copy; Jobolos Photography 2024</div>
    </footer>

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
    {{-- <script src="{{ asset('/') }}plugins/moment/moment.min.js"></script>
    <script src="{{ asset('/') }}plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('/') }}plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="{{ asset('/') }}plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('/') }}plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('/') }}dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('/') }}dist/js/pages/dashboard.js"></script> --}}
    <!-- AdminLTE App -->
    <script src="{{ asset('/') }}dist/js/adminlte.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    {{-- <script src="sweetalert2.all.min.js"></script> --}}

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

    {{-- CK Editor --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

    <!-- MDB -->
    {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.1/mdb.umd.min.js"></script> --}}


    {{-- FULL CALENDAR JAVASCRIPT --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: '/jobolos/photoshoot-info/getBookings',
                eventDidMount: function(info) {
                    var now = new Date();
                    var eventDate = new Date(info.event.start);

                    if (eventDate < now.setHours(0, 0, 0, 0)) {
                        info.el.style.display = 'none'; // Hide the event element
                    }
                }
            });
            calendar.render();
        });
    </script>

    <script>
        window.addEventListener('load', () => {
            const loader = document.querySelector(".loader");

            loader.classList.add("loader-hidden");

            loader.addEventListener("transitionend", () => {
                document.body.removeChild("loader");
            })
        })

        $(document).ready(function() {
            $(window).scroll(function() {
                if ($(this).scrollTop() > 50) { // Sesuaikan nilai 50 dengan tinggi navbar
                    $('.nav-scroll').addClass('scrolled');
                    $('.nav-scroll-2').addClass('scrolled');
                    $('.nav-brand').addClass('scrolled');
                    $('.back-to-top').fadeIn();
                } else {
                    $('.nav-scroll').removeClass('scrolled');
                    $('.nav-scroll-2').removeClass('scrolled');
                    $('.nav-brand').removeClass('scrolled');
                    $('.back-to-top').fadeOut();
                }
            });

            $('.back-to-top').click(function(e) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: 0
                }, '300'); // Adjust the animation speed here
            });
        });
    </script>



    @yield('scripts')
</body>

</html>
