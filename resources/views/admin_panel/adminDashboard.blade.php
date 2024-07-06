@extends('layouts.admin_panel.adminLayouts')

@section('title', 'Dashboard Admin')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Admin Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <h2>Halo, Selamat Datang <b>{{ ucwords(Auth::user()->name) }}</b>, Anda adalah
                        {{ ucwords(Auth::user()->nama_role->name) }}. </h2>

                    <!-- ./col -->
                    <div class="col-lg-4 col-12">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $userRegistered }}</h3>

                                <p>User Registrations</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="/admin_panel/adminManageUser" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <!-- small box -->
                        <div class="small-box bg-success-subtle">
                            <div class="inner">
                                <h3>Rp {{ number_format($pendapatanPhotoshoot, 0, ',', '.') }}</h3>

                                <p>Pendapatan Photoshoot Bulan ini</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-solid fa-hand-holding-dollar"></i>
                            </div>
                            <a href="/admin_panel/adminManageUser" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>Rp {{ number_format($pendapatanRental, 0, ',', '.') }}</h3>

                                <p>Pendapatan Rental Kamera Bulan ini</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-solid fa-hand-holding-dollar"></i>
                            </div>
                            <a href="/admin_panel/adminManageUser" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-6 col-12">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $newBooking }}</h3>

                                <p>New Bookings Unpaid</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="/admin_panel/adminManageBookingReceived" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-6 col-12">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                {{-- <h3>53<sup style="font-size: 20px">%</sup></h3> --}}
                                <h3>{{ $paymentConfirm }}</h3>

                                <p>Booking Payments Confirmation</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-solid fa-hand-holding-dollar"></i>
                            </div>
                            <a href="/admin_panel/adminManageBookingConfirmation" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $newRentalBooking }}</h3>

                                <p>New Rental Camera Bookings Unpaid</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="/admin_panel/adminManageBookingReceived" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <!-- small box -->
                        <div class="small-box bg-success-subtle">
                            <div class="inner">
                                {{-- <h3>53<sup style="font-size: 20px">%</sup></h3> --}}
                                <h3>{{ $paymentRentalConfirm }}</h3>

                                <p>Rental Camera Payments Confirmation</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-solid fa-hand-holding-dollar"></i>
                            </div>
                            <a href="/admin_panel/adminManageBookingConfirmationRental"
                                class="small-box-footer text-success">More info
                                <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                </div>
            </div>
            <div class="container">
                <div class="card col-lg-12 p-5">
                    <h2>Photoshoot Booked Date</h2>
                    <div class="p-3 col-lg-12">
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>

        </section>
    </div>



    {{-- footer --}}
    {{-- @include('layouts.admin_panel.footerLayout') --}}

@endsection
