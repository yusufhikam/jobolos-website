@extends('layouts.admin_panel.adminLayouts')

@section('title', 'Admin | Photoshoot Boking Confirmed')
@section('content')
    @php
        use Carbon\Carbon;
    @endphp

    <style>
        .container {
            width: 100%;
            max-width: 800px;
            margin: auto;
            padding: 10px;
            /* position: relative; */
            /* Mengatur posisi relatif untuk container */

        }

        .card {
            border: 1px solid #ddd;
            border-radius: 15px;
            padding: 10px;
            margin-bottom: 10px;
        }

        .card-header,
        .card-body {
            padding: 10px;
        }

        .card-body p {
            font-size: 8pt;
        }

        .text-center {
            text-align: center;
        }

        .brand-logo {
            width: 100px;
        }

        .brand-title {
            font-size: 20px;
            margin: 5px;
        }

        .detail-heading {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .code p {
            font-size: 14px;
            font-weight: bold;
        }

        .customer-data,
        .photoshoot-detail {
            margin-bottom: 20px;
        }

        .customer-info,
        .photoshoot-info {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
            font-size: 10pt;
        }

        .customer-info td,
        .photoshoot-info td {
            padding: 5px;
            /* border: 1px solid #ddd; */
            /* vertical-align: middle; */
            text-align: center;
        }

        .text-primary {
            color: #007bff;
        }

        .mb-4 {
            margin-bottom: 0;
        }

        .mt-5 {
            margin-top: 0;
        }

        .row-details {
            display: table;
            width: 100%;
            border-spacing: 10px;
        }

        .col-6 {
            display: table-cell;
            width: 50%;
        }

        .card-body {
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
        }

        .text-center {
            text-align: center;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
        }

        h4,
        h6 {
            margin: 0;
        }

        /* .label-title {
                        margin-bottom: 3px;
                    } */

        .item-price {
            background-color: green;
            display: inline;
            color: #fff;
            padding: 3px;
        }

        #text-confirm {
            background-color: #007bff;
            display: inline;
            padding: 3px;
            color: #fff;
            border-radius: 2px;
            font-size: 8pt;
            word-spacing: 2px;
        }

        .signature {
            width: 300px;
            /* Lebar signature */
            text-align: start;
            /* border-top: 1px solid #ddd; */
            /* Garis atas untuk memisahkan dari konten sebelumnya */
            padding: 15px 0 0 20px;
            /* Padding atas untuk ruang antara garis atas dan teks signature */
            font-size: 15pt;
            /* Ukuran font untuk signature */
        }

        .signature p {
            /* padding: 1px; */
            margin: 0px;
            font-size: 10pt;
            font-weight: 600;
            /* Ukuran font untuk signature */
        }
    </style>
    <div class="content-wrapper ">
        {{-- breadcrumb --}}

        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h3 class="m-2">Confirmed Photoshoot Booking Payment</h3>
                    <hr>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right m-2">
                        <li class="breadcrumb-item "><a href="/admin_panel/adminDashboard">Admin Dashboard</a>
                        </li>
                        <li class="breadcrumb-item "><a href="/admin_panel/adminManageBookingConfirmation">Booking
                                Confirmation List</a>
                        </li>
                        <li class="breadcrumb-item active">Confirmed Payment</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->

        <div class="container-fluid mb-5">
            <div class="col">

                <div class="float-start">
                    <a href="/admin_panel/adminManageBookingConfirmation" class="btn btn-warning"><i
                            class="fa-solid fa-circle-left"></i> Kembali</a>
                </div>
                <div class="float-end">
                    <a href="{{ route('admin_panel.downloadPDF', $payments->id) }}" class="btn btn-primary">Unduh PDF</a>
                </div>
            </div>
        </div>

        <section class="content p-4">
            <div class="container border border-2 bg-light">
                <div class="card-header">
                    <div class="text-center">
                        <img src="{{ 'data:image/png;base64,' . base64_encode(file_get_contents(asset('/storage/frontend_assets/brand-logo/jobolos-logo-black.png'))) }}"
                            alt="Jobolos Logo" class="brand-logo">
                        <h1 class="brand-title">JOBOLOS PHOTOGRAPHY REMBANG</h1>
                        <h5 class="detail-heading">Photoshoot Booking Confirmation Detail</h5>
                        <hr>
                    </div>
                    <div class="code">
                        <p>BOOKING CODE :
                            PS-{{ str_pad($payments->bookings->id, 4, '0', STR_PAD_LEFT) }}-{{ $payments->bookings->count() }}
                        </p>
                        <hr>
                    </div>
                </div>
                <div class="card-body">
                    <div class="customer-data mb-4">
                        <h4>Customer Data</h4>
                        <hr>
                    </div>
                    <table class="customer-info">
                        <tr>
                            <td>
                                <h6 class="text-primary label-title">Name :</h6>
                                <h6>{{ $payments->bookings->users->name }}</h6>
                            </td>
                            <td>
                                <h6 class="text-primary label-title">Email :</h6>
                                <h6>{{ $payments->bookings->users->email }}</h6>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h6 class="text-primary label-title">WhatsApp :</h6>
                                <h6>{{ $payments->bookings->users->no_telp }}</h6>
                            </td>
                            <td>
                                <h6 class="text-primary label-title">Location :</h6>
                                <h6>{{ $payments->bookings->location_type == 'other' ? 'Luar Kota' : 'Kabupaten Rembang' }}
                                </h6>
                            </td>
                        </tr>
                    </table>

                    <div class="photoshoot-detail mt-5">
                        <div class="mb-4">
                            <h4>Photoshoot Detail</h4>
                            <hr>
                        </div>
                        <table class="photoshoot-info">
                            <tr>
                                <td>
                                    <h6 class="text-primary label-title">Package :</h6>
                                    <p style="font-weight: 700; font-size:10pt;">{{ $payments->bookings->packages->name }}
                                    </p>
                                    <p class="item-price">Rp
                                        {{ number_format($payments->bookings->packages->harga, 0, ',', '.') }}</p>
                                </td>
                                <td>
                                    <h6 class="text-primary label-title">Estimate Event Date :</h6>
                                    <h6>{{ Carbon::parse($payments->bookings->tanggal)->locale('id')->translatedFormat('l, j F Y') }}
                                    </h6>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h6 class="text-primary label-title">Payment Type :</h6>
                                    <p style="font-weight: 700; font-size:10pt;">
                                        {{ $payments->bookings->payment_type == 'full' ? 'Full Payment' : 'DP' }}</p>
                                    <p class="item-price">Rp
                                        {{ number_format($payments->bookings->total_harga, 0, ',', '.') }}
                                    </p>
                                </td>
                                <td>
                                    <h6 class="text-primary label-title">Status Payment :</h6>
                                    <h6 id="text-confirm">
                                        {{ $payments->status == 'approved' ? 'TELAH DI KONFIRMASI VALID' : '' }} <i
                                            class="fa text-primary fa-solid fa-check-circle"></i></h6>
                                </td>
                            </tr>
                        </table>

                        <div class="row-details">
                            <div class="col-6 col-details">
                                <div class="card-body">
                                    <h6 class="text-primary">Detail Location:</h6>
                                    <p>{{ $payments->bookings->location }}</p>
                                </div>
                            </div>
                            <div class="col-6 col-details">
                                <div class="card-body">
                                    <h6 class="text-primary">Photoshoot Concept:</h6>
                                    <p>{{ $payments->bookings->concept }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="signature-container">
                            <div class="signature">
                                <p style="margin-bottom: 10px;">
                                    {{ Carbon::parse($payments->updated_at)->locale('id')->translatedFormat('l, j F Y') }}
                                </p>
                                <h6 class="text-primary">Confirmed by</h6>
                                <p>{{ ucwords(Auth::user()->name) }}
                                </p>
                            </div>
                        </div>


                        <div class="text-center mt-4" style="margin-top: 10px;">
                            <p>Jika ada pertanyaan silahkan WhatsApp Admin <br>Thank You :)</p>
                        </div>

                        {{-- <a href="{{ route('admin_panel.downloadPDF', $payments->id) }}" class="btn btn-primary">Download
                            PDF</a> --}}

                    </div>
                </div>
            </div>

        </section>
    </div>

@endsection
