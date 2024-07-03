@extends('layouts.admin_panel.adminLayouts')

@section('title', 'Admin | Booking Received')
@section('content')

    <div class="content-wrapper">
        {{-- breadcrumb --}}

        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-2">Booking Received List</h1>
                    <hr>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right m-2">
                        <li class="breadcrumb-item active">Booking List</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->


        <section class="content">
            <div class="container-fluid">
                <div class="row my-3 ms-2 me-2 justify-content-between ">
                    <div class=" col-auto mb-2">
                        <p>Halaman ini berisi daftar customer yang telah melakukan booking Photoshoot</p>
                    </div>


                    <div class=" col-auto mb-2">
                        <form class="d-flex" action="" method="get" role="search">
                            <input type="search" class="form-control me-2" name="keyword" placeholder="Search Data"
                                value="{{ request()->input('keyword') }}">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
                </div>

                <div class="d-inline-flex my-4 ms-4 border bg-info bg-opacity-10 border-info rounded ">
                    <div class="btn-group dropend ">
                        <button type="button" class="btn dropdown-toggle btn-filtering " data-bs-toggle="dropdown"
                            aria-expanded="false"><i class="fa-solid fa-filter " style="color: #ffd500;"></i> Filtering By
                        </button>
                        <form action="/admin_panel/adminManageBookingReceived" method="GET">
                            @csrf
                            <ul class="dropdown-menu">
                                <li>
                                    <button type="submit" class="dropdown-item" aria-current="true"
                                        name="status_pembayaran" value="completed">Terbayar</button>
                                    <button type="submit" class="dropdown-item" aria-current="true"
                                        name="status_pembayaran" value="pending">Menunggu
                                        Pembayaran</button>
                                    <button type="submit" class="dropdown-item" aria-current="true"
                                        name="status_pembayaran" value="cancelled">Dibatalkan</button>
                                </li>
                            </ul>
                        </form>
                    </div>
                    <div class="btn-group">
                        <a href="/admin_panel/adminManageBookingReceived" class="btn btn-filtering"><i
                                class="fa-solid fa-ban" style="color: #ff0000;"></i> No Filtering</a>
                    </div>
                </div>

                {{-- <div class="container"> --}}

                <div class="table-responsive-lg ">

                    @if ($alert)
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
                                    <th>Nama Customer</th>
                                    <th>Package</th>
                                    <th class="location-col">Detail Location</th>
                                    <th>Konsep Foto</th>
                                    <th>Estimasi Tanggal</th>
                                    <th>Total Harga</th>
                                    <th>Tipe Pembayaran</th>
                                    <th>Status Pembayaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($booking as $bookList)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col">
                                                        <p style="font-size: 10pt;">Nama :
                                                            <span>{{ $bookList->users->name }}</span>
                                                        </p>

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <p style="font-size: 10pt;">Email :
                                                        <span>{{ $bookList->users->email }}</span>
                                                    </p>
                                                </div>
                                                <div class="row">
                                                    <p style="font-size: 10pt;">WA : <span>
                                                            {{ $bookList->users->no_telp }}</span></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p>{{ $bookList->packages->name }}</p>
                                            <p>Rp {{ number_format($bookList->packages->harga, 0, ',', '.') }}</p>
                                        </td>
                                        <td class="location-col col-lg-2">
                                            <div class="row ">
                                                <label>Location : </label>
                                                @if ($bookList->location_type == 'rembang')
                                                    <p>Kabupaten Rembang</p>
                                                @else
                                                    <p>Luar Kota</p>
                                                @endif
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <label>Detail Location : </label>
                                                <p>{{ $bookList->location }}
                                                </p>
                                            </div>
                                        </td>
                                        <td class="location-col">{{ $bookList->concept }}</td>
                                        <td class="text-center">
                                            {{ \Carbon\Carbon::parse($bookList->tanggal)->translatedFormat('j F Y') }}</td>
                                        <td class="text-center">Rp {{ number_format($bookList->total_harga, 0, ',', '.') }}
                                        </td>
                                        <td class="text-center">
                                            @if ($bookList->payment_type == 'full')
                                                Full Payment
                                            @else
                                                DP
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($bookList->status_pembayaran == 'pending')
                                                <p class="bg-warning rounded p-2 text-center"
                                                    style="font-size: 10pt; margin:0;">
                                                    Menunggu pembayaran..
                                                </p>
                                            @elseif($bookList->status_pembayaran == 'completed')
                                                <p class="bg-primary rounded p-2 text-center"
                                                    style="font-size: 10pt; margin:0;">
                                                    Telah Dibayar
                                                </p>
                                            @else
                                                <p class="bg-danger rounded p-2 text-center"
                                                    style="font-size: 10pt; margin:0;">
                                                    Dibatalkan
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
                        {{ $booking->withQueryString()->links() }}
                    </div>
                </div>
                {{-- </div> --}}
            </div>
        </section>
    </div>

@endsection
