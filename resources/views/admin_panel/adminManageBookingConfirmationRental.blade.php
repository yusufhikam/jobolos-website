@extends('layouts.admin_panel.adminLayouts')

@section('title', 'Admin | payment Booking Confirmation')
@section('content')

    <div class="content-wrapper">
        {{-- breadcrumb --}}

        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-2">Rental Kamera Booking Confirmation List</h1>
                    <hr>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right m-2">
                        <li class="breadcrumb-item "><a href="/admin_panel/adminDashboard">Admin Dashboard</a></li>
                        <li class="breadcrumb-item active">Rental Kamera Booking Confirmation List</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->


        <section class="content">
            <div class="container-fluid">
                <div class=" col-lg-4 mb-2">
                    <ul>
                        <li class="mb-1">Halaman ini berisi daftar customer yang telah melakukan pembayaran Rental Kamera
                        </li>
                        <li class="mb-1">Sebelum melakukan <b class="text-danger">Konfirmasi</b>, cek Mutasi
                            Rekenening Anda dan bandingkan
                            dengan Foto Bukti
                            Pembayaran dibawah. <b class="text-danger">Klik foto untuk memperbesar</b>
                        </li>
                        <li class="mb-1">Jika tidak valid <b class="text-danger">Tolak</b>. Customer akan mengupload
                            ulang foto bukti pembayaran.</li>
                    </ul>
                </div>
                {{-- FORM CARI DATA BOOKING CAMERA payment --}}
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
                                    href="{{ route('admin_panel.adminManageBookingConfirmationRental', ['status_pembayaran' => 'pending']) }}">Menunggu
                                    Konfirmasi</a>
                                <a class="dropdown-item"
                                    href="{{ route('admin_panel.adminManageBookingConfirmationRental', ['status_pembayaran' => 'approved']) }}">Telah
                                    Dikonfirmasi</a>
                                <a class="dropdown-item"
                                    href="{{ route('admin_panel.adminManageBookingConfirmationRental', ['status_pembayaran' => 'rejected']) }}">Tolak</a>
                            </div>
                        </div>
                        <div class="btn-group">
                            <a href="/admin_panel/adminManageBookingConfirmationRental" class="btn btn-filtering"><i
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
                        @if ($payments->isEmpty())
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
                                        <th>Bukti Pembayaran</th>
                                        <th>Nama Kamera</th>
                                        <th>Lensa</th>
                                        <th>Jaminan</th>
                                        <th>Tanggal Sewa</th>
                                        <th>Tanggal Pengembalian</th>
                                        <th>Total Pembayaran</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($payments as $payment)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="col">
                                                    <div class="col m-0">
                                                        <p>Nama:
                                                            {{ $payment->rentals->users->name }}</p>
                                                    </div>
                                                    <div class="col m-0">
                                                        <p>Email:
                                                            {{ $payment->rentals->users->email }}</p>
                                                    </div>
                                                    <div class="col m-0">
                                                        <p>WhatsApp :
                                                            {{ $payment->rentals->users->no_telp }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center align-items-center">
                                                <div>
                                                    <a type="button" class="img-modal" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal{{ $payment->id }}">
                                                        <img src="/storage/admin_assets/buktiPembayaran/bukti_pembayaran_rental_camera/{{ $payment->bukti_pembayaran }}"
                                                            width="75" height="75" class="img-fluid"
                                                            alt="bukti pembayaran">
                                                    </a>
                                                </div>
                                                <div class="modal fade" id="exampleModal{{ $payment->id }}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered ">
                                                        <div class="modal-content">
                                                            <img src="/storage/admin_assets/buktiPembayaran/bukti_pembayaran_rental_camera/{{ $payment->bukti_pembayaran }}"
                                                                class="img-fluid" alt="bukti pembayaran">
                                                        </div>
                                                    </div>
                                                </div>

                                            </td>
                                            <td>
                                                <p>{{ $payment->rentals->cameras->camera_types->brands->name }}
                                                    {{ $payment->rentals->cameras->name }}</p>
                                            </td>
                                            <td>
                                                <p>{{ $payment->rentals->lenses->name }} [
                                                    {{ $payment->rentals->lenses->camera_types->name }}
                                                    ]
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-center">{{ $payment->rentals->jaminan }}</p>
                                            </td>
                                            <td>
                                                <p class="text-center">
                                                    {{ \Carbon\Carbon::parse($payment->rentals->tgl_sewa)->translatedFormat('j F Y') }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-center">
                                                    {{ \Carbon\Carbon::parse($payment->rentals->tgl_kembali)->translatedFormat('j F Y') }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-center">Rp
                                                    {{ number_format($payment->rentals->total_harga, 0, ',', '.') }}</p>
                                            </td>
                                            <td class="text-center">
                                                @if ($payment->rentals->status == 'completed')
                                                    <div class="bg-info rounded " role="alert">
                                                        <p style="font-size: 10pt;"><i class="fa-solid fa-circle-check"></i>
                                                            Sudah Dikembalikan</p>
                                                    </div>
                                                @elseif ($payment->status_pembayaran == 'pending')
                                                    <div class="bg-warning rounded  " role="alert">
                                                        <p style="font-size: 10pt;"><i
                                                                class="fa-solid fa-triangle-exclamation"></i> Perlu
                                                            dikonfirmasi
                                                        </p>
                                                    </div>
                                                @elseif($payment->status_pembayaran == 'approved')
                                                    <div class="bg-success rounded " role="alert">
                                                        <p style="font-size: 10pt;"><i
                                                                class="fa-solid fa-circle-check"></i>
                                                            Telah dikonfirmasi</p>
                                                    </div>
                                                @else
                                                    <div class="bg-danger rounded " role="alert">
                                                        <p style="font-size: 10pt;"><i
                                                                class="fa-solid fa-circle-xmark"></i>
                                                            Tolak</p>
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <div class="container text-center">
                                                    <div class="row g-1 align-items-center">
                                                        <div class="col d-grid">
                                                            <form
                                                                action="/admin_panel/adminManageBookingConfirmationRental/approve/{{ $payment->id }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')

                                                                <button type="submit"
                                                                    class="btn btn-primary col-lg-12 @if ($payment->status_pembayaran == 'approved') disabled @endif">Konfirmasi</button>

                                                            </form>
                                                        </div>
                                                        <div class="col d-grid">
                                                            <form
                                                                action="/admin_panel/adminManageBookingConfirmationRental/rejected/{{ $payment->id }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')

                                                                <button type="submit"
                                                                    class="btn btn-danger col-lg-12 @if ($payment->status_pembayaran == 'approved') disabled @endif">Tolak</button>
                                                            </form>
                                                        </div>
                                                        @if ($payment->status_pembayaran == 'approved')
                                                            <div class="col d-grid">
                                                                <form
                                                                    action="/admin_panel/adminManageBookingConfirmationRental/completed/{{ $payment->id }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PUT')

                                                                    <button type="submit"
                                                                        class="btn btn-success col-lg-12"
                                                                        @if ($payment->rentals->status == 'completed') disabled @endif>PENYEWAAN
                                                                        SELESAI</button>
                                                                </form>
                                                            </div>
                                                        @endif
                                                        {{-- <div class="col">
                                                        <button class="btn btn-primary"></button>
                                                    </div> --}}
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                        {{-- PAGINATION --}}
                        {{-- <div class="mt-2">
                            {{ $cameras->withQueryString()->links() }}
                        </div> --}}
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
