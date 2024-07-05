@extends('layouts.admin_panel.adminLayouts')

@section('title', 'Admin | Rental Booking Received')
@section('content')

    <div class="content-wrapper">
        {{-- breadcrumb --}}

        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-2">Rental Booking Received List</h1>
                    <hr>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right m-2">
                        <li class="breadcrumb-item "><a href="/admin_panel/adminDashboard">Admin Dashboard</a></li>
                        <li class="breadcrumb-item active">Rental Booking Received List</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->


        <section class="content">
            <div class="container-fluid">
                {{-- FORM CARI DATA BOOKING CAMERA RENTAL --}}
                <div class="row justify-content-between">
                    {{-- FILTERING DATA --}}
                    <div class="col-lg-3 col-10 ms-2 d-flex mb-3 border bg-info bg-opacity-10 border-info rounded ">
                        <div class="btn-group dropend ">
                            <button type="button" class="btn dropdown-toggle btn-filtering" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="fa-solid fa-filter" style="color: #ffd500;"></i> Filtering By
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item"
                                    href="{{ route('admin_panel.adminManageBookingReceivedRental', ['status' => 'pending']) }}">Menunggu
                                    Pembayaran</a>
                                <a class="dropdown-item"
                                    href="{{ route('admin_panel.adminManageBookingReceivedRental', ['status' => 'waiting']) }}">Menunggu
                                    Konfirmasi</a>
                                <a class="dropdown-item"
                                    href="{{ route('admin_panel.adminManageBookingReceivedRental', ['status' => 'active']) }}">Kamera
                                    Sedang
                                    Disewa</a>
                                <a class="dropdown-item"
                                    href="{{ route('admin_panel.adminManageBookingReceivedRental', ['status' => 'completed']) }}">Kamera
                                    Telah Dikembalikan</a>
                            </div>
                        </div>
                        <div class="btn-group">
                            <a href="/admin_panel/adminManageBookingReceivedRental" class="btn btn-filtering"><i
                                    class="fa-solid fa-ban" style="color: #ff0000;"></i> No Filtering</a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="col-lg-12 col-sm-12 mb-4 float-end">
                            <form class="d-flex" action="" method="get" role="search">
                                <input type="search" class="form-control me-2" name="keyword" placeholder="Search Data"
                                    value="{{ request()->input('keyword') }}">
                                <button class="btn btn-outline-success" type="submit">Search</button>
                            </form>
                        </div>
                        @if (Session::has('status'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('message') }}
                            </div>
                        @endif
                    </div>
                </div>
                {{-- TABLE CAMERA LIST --}}
                <div class="container-fluid">
                    <div class="table-responsive">
                        @if ($rentals->isEmpty())
                            <div class=" alert alert-danger text-center " role="alert">
                                <h2>Oops!</h2>
                                <p>{{ $alert }}
                                </p>
                            </div>
                        @else
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="table-primary text-center">
                                        <th>No</th>
                                        <th>Data Customer</th>
                                        <th>Nama Kamera</th>
                                        <th>Lensa</th>
                                        <th>Jaminan</th>
                                        <th>Tanggal Sewa</th>
                                        <th>Tanggal Pengembalian</th>
                                        <th>Total Pembayaran</th>
                                        <th>Status Pembayaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rentals as $rental)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="col">
                                                    <div class="col m-0">
                                                        <p>Nama:
                                                            {{ $rental->users->name }}</p>
                                                    </div>
                                                    <div class="col m-0">
                                                        <p>Email:
                                                            {{ $rental->users->email }}</p>
                                                    </div>
                                                    <div class="col m-0">
                                                        <p>WhatsApp :
                                                            {{ $rental->users->no_telp }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p>{{ $rental->cameras->camera_types->brands->name }}
                                                    {{ $rental->cameras->name }}</p>
                                            </td>
                                            <td>
                                                <p>{{ $rental->lenses->name }} [ {{ $rental->lenses->camera_types->name }}
                                                    ]
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-center">{{ $rental->jaminan }}</p>
                                            </td>
                                            <td>
                                                <p class="text-center">
                                                    {{ \Carbon\Carbon::parse($rental->tgl_sewa)->translatedFormat('j F Y') }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-center">
                                                    {{ \Carbon\Carbon::parse($rental->tgl_kembali)->translatedFormat('j F Y') }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-center">Rp
                                                    {{ number_format($rental->total_harga, 0, ',', '.') }}</p>
                                            </td>
                                            <td class="text-center">
                                                @if ($rental->status == 'pending')
                                                    <p class="bg-warning rounded p-2 text-center"
                                                        style="font-size: 10pt; margin:0;">
                                                        Menunggu pembayaran..
                                                    </p>
                                                @elseif($rental->status == 'waiting')
                                                    <p class="bg-primary rounded p-2 text-center"
                                                        style="font-size: 10pt; margin:0;">
                                                        Menunggu Konfirmasi
                                                    </p>
                                                @elseif($rental->status == 'active')
                                                    <p class="bg-success rounded p-2 text-center"
                                                        style="font-size: 10pt; margin:0;">
                                                        Kamera Sedang Disewa
                                                    </p>
                                                @else
                                                    <p class="bg-info rounded p-2 text-center"
                                                        style="font-size: 10pt; margin:0;">
                                                        Kamera Sudah Dikembalikan
                                                    </p>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                        {{-- PAGINATION --}}
                        <div class="mt-2">
                            {{ $rentals->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @include('sweetalert::alert')

@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Menangani submenu pada dropdown filtering
            document.querySelectorAll('.dropdown-submenu a.dropdown-toggle').forEach(function(element) {
                element.addEventListener('click', function(e) {
                    e.stopPropagation();
                    e.preventDefault();

                    var submenu = element.nextElementSibling;

                    if (submenu.classList.contains('show')) {
                        submenu.classList.remove('show');
                    } else {
                        // Tutup semua submenu yang sedang terbuka
                        document.querySelectorAll('.dropdown-submenu .dropdown-menu-filtering.show')
                            .forEach(function(sub) {
                                sub.classList.remove('show');
                            });

                        submenu.classList.add('show');
                    }
                });
            });

            // Tutup submenu saat dropdown utama tertutup
            document.querySelectorAll('.btn-filtering').forEach(function(button) {
                button.addEventListener('click', function() {
                    document.querySelectorAll('.dropdown-submenu .dropdown-menu-filtering.show')
                        .forEach(function(sub) {
                            sub.classList.remove('show');
                        });
                });
            });
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-button').forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const form = this.closest('form');
                    Swal.fire({
                        title: "Apakah Anda yakin ingin Menghapus Data User?",
                        text: "Anda Tidak Dapat Mengembalikan Data yang sudah dihapus",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Delete!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
