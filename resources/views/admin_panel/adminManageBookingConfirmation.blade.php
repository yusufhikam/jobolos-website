@extends('layouts.admin_panel.adminLayouts')

@section('title', 'Admin | Booking Confirmation')
@section('content')

    <div class="content-wrapper">
        {{-- breadcrumb --}}

        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-2">Kelola Konfirmasi Pembayaran</h1>
                    <hr>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right m-2">
                        <li class="breadcrumb-item active">Kelola Konfirmasi Pembayaran</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->


        <section class="content">
            <div class="container-fluid">
                <div class="row my-3 ms-2 me-2 justify-content-between ">
                    <div class=" col-lg-4 mb-2">
                        <ul>
                            <li class="mb-1">Halaman ini berisi daftar customer yang telah melakukan pembayaran Photoshoot
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


                </div>
                <div class=" col-lg-6 col-sm-12 float-end mb-2">
                    <form class="d-flex" action="" method="get" role="search">
                        <input type="search" class="form-control me-2" name="keyword" placeholder="Search Data"
                            value="{{ request()->input('keyword') }}">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>

                {{-- <a href="/mail/invoiceBooking" class="btn btn-primary">invoice</a> --}}

                <div class="d-inline-flex my-4 ms-4 border bg-info bg-opacity-10 border-info rounded ">
                    <div class="btn-group dropend ">
                        <button type="button" class="btn dropdown-toggle btn-filtering " data-bs-toggle="dropdown"
                            aria-expanded="false"><i class="fa-solid fa-filter " style="color: #ffd500;"></i> Filtering By
                        </button>

                        <form action="/admin_panel/adminManageBookingConfirmation" method="GET">
                            @csrf
                            <ul class="dropdown-menu">
                                <li>
                                    <button type="submit" class="dropdown-item" aria-current="true" name="status"
                                        value="approved">Terkonfirmasi</button>
                                    <button type="submit" class="dropdown-item" aria-current="true" name="status"
                                        value="pending">Menunggu
                                        Konfirmasi</button>
                                    <button type="submit" class="dropdown-item" aria-current="true" name="status"
                                        value="rejected">Ditolak</button>
                                </li>
                            </ul>
                        </form>
                    </div>
                    <div class="btn-group">
                        <a href="/admin_panel/adminManageBookingConfirmation" class="btn btn-filtering"><i
                                class="fa-solid fa-ban" style="color: #ff0000;"></i> No Filtering</a>
                    </div>
                </div>


                <div class="table-responsive">
                    @if ($alert)
                        <div class=" alert alert-danger text-center " role="alert">
                            <h2>Oops!</h2>
                            <p>{{ $alert }}
                            </p>
                        </div>
                    @else
                        {{-- @if ($alert)
                        <div class=" alert alert-danger text-center " role="alert">
                            <h2>Oops!</h2>
                            <p>{{ $alert }}
                            </p>
                        </div>
                    @else --}}
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr class="table-primary text-center">
                                    <th>No</th>
                                    <th>Data Customer</th>
                                    <th>Package</th>
                                    <th>Bukti Pembayaran</th>
                                    <th>Jumlah Pembayaran</th>
                                    {{-- <th>Estimasi Tanggal</th> --}}
                                    <th>Tipe Pembayaran</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                    {{-- <th>Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payments as $bookList)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col">
                                                        <p style="font-size: 10pt;">Nama :
                                                            <span>{{ $bookList->bookings->users->name }}</span>
                                                        </p>

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <p style="font-size: 10pt;">Email :
                                                        <span>{{ $bookList->bookings->users->email }}</span>
                                                    </p>
                                                </div>
                                                <div class="row">
                                                    <p style="font-size: 10pt;">WA : <span>
                                                            {{ $bookList->bookings->users->no_telp }}</span></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <p style="font-size: 10pt;">{{ $bookList->bookings->packages->name }}
                                                    </p>
                                                </div>
                                                <div class="row">
                                                    <p style="font-size: 10pt;"> Rp
                                                        {{ number_format($bookList->bookings->packages->harga, 0, ',', '.') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center align-items-center">
                                            <div>
                                                <a type="button" class="img-modal" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal{{ $bookList->id }}">
                                                    <img src="/storage/admin_assets/buktiPembayaran/bukti_pembayaran_photoshoot/{{ $bookList->bukti_pembayaran }}"
                                                        width="75" height="75" class="img-fluid"
                                                        alt="bukti pembayaran">
                                                </a>
                                            </div>
                                            <div class="modal fade" id="exampleModal{{ $bookList->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered ">
                                                    <div class="modal-content">
                                                        <img src="/storage/admin_assets/buktiPembayaran/bukti_pembayaran_photoshoot/{{ $bookList->bukti_pembayaran }}"
                                                            class="img-fluid" alt="bukti pembayaran">
                                                    </div>
                                                </div>
                                            </div>

                                        </td>
                                        <td class="text-center">
                                            <p>Rp
                                                {{ number_format($bookList->bookings->total_harga, 0, ',', '.') }}</p>
                                        </td>

                                        {{-- <td class="text-center">
                                        {{ \Carbon\Carbon::parse($bookList->tanggal)->translatedFormat('j F Y') }}</td> --}}
                                        <td class="text-center">
                                            {{-- <h5>{{ $bookList->bookings->payment_type }}</h5> --}}
                                            <div class="container-fluid">
                                                <div class="row">
                                                    @if ($bookList->bookings->payment_type == 'dp')
                                                        <p style="font-size: 10pt;" class="bg-success">DP</p>
                                                    @else
                                                        <p style="font-size: 10pt;" class="bg-primary">Full Payment</p>
                                                    @endif
                                                </div>
                                                <div class="row">
                                                    @if ($bookList->bookings->location_type == 'other')
                                                        <p style="font-size: 10pt;">(Luar Kota)</p>
                                                    @else
                                                        <p style="font-size: 10pt;">(Kabupaten Rembang)
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            @if ($bookList->status == 'pending')
                                                {{-- <div class="bg-warning rounded p-1 " role="alert"> --}}
                                                <p style="font-size: 10pt;" class="bg-warning"><i
                                                        class="fa-solid fa-triangle-exclamation"></i> Perlu
                                                    dikonfirmasi
                                                </p>
                                                {{-- </div> --}}
                                            @elseif($bookList->status == 'approved')
                                                {{-- <div class="bg-success rounded p-1" role="alert"> --}}
                                                <p style="font-size: 10pt;" class="bg-success"><i
                                                        class="fa-solid fa-circle-check"></i>
                                                    Telah dikonfirmasi</p>
                                                {{-- </div> --}}
                                            @else
                                                <div class="bg-danger rounded p-1" role="alert">
                                                    <p style="font-size: 10pt;"><i class="fa-solid fa-circle-xmark"></i>
                                                        Tolak</p>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="container text-center">
                                                <div class="row g-1 align-items-center">
                                                    <div class="col d-grid">
                                                        <form
                                                            action="/admin_panel/adminManageBookingConfirmation/approve/{{ $bookList->id }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')

                                                            <button type="submit"
                                                                class="btn btn-primary col-lg-12 @if ($bookList->status == 'approved') disabled @endif">Konfirmasi</button>

                                                        </form>
                                                    </div>
                                                    <div class="col d-grid">
                                                        <form
                                                            action="/admin_panel/adminManageBookingConfirmation/rejected/{{ $bookList->id }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')

                                                            <button type="submit"
                                                                class="btn btn-danger col-lg-12 @if ($bookList->status == 'approved') disabled @endif">Tolak</button>
                                                        </form>
                                                    </div>
                                                    @if ($bookList->status == 'approved')
                                                        <div class="col d-grid">
                                                            <a href="/admin_panel/adminManageBookingConfirmation/Detail-Booking-Confirmed/{{ $bookList->id }}/{{ $bookList->bookings->users->name }}"
                                                                class="btn btn-success">Detail</a>
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
                        {{-- @endif --}}

                    @endif
                    {{-- PAGINATION --}}

                    <div class="mt-2">
                        {{ $payments->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
