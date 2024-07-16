@php
    use Carbon\Carbon;
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            /* font-size: small; */
        }

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

        .label-title {
            margin-bottom: 5px;
        }

        .item-price {
            background-color: green;
            display: inline;
            color: #fff;
            padding: 3px;
            margin-top: 2px;
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

</head>

<body>
    <div class="container">
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
                    PS-{{ str_pad($booking->bookings->id, 4, '0', STR_PAD_LEFT) }}-{{ $booking->bookings->count() }}
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
                        <h6>{{ $booking->bookings->users->name }}</h6>
                    </td>
                    <td>
                        <h6 class="text-primary label-title">Email :</h6>
                        <h6>{{ $booking->bookings->users->email }}</h6>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h6 class="text-primary label-title">WhatsApp :</h6>
                        <h6>{{ $booking->bookings->users->no_telp }}</h6>
                    </td>
                    <td>
                        <h6 class="text-primary label-title">Location :</h6>
                        <h6>{{ $booking->bookings->location_type == 'other' ? 'Luar Kota' : 'Kabupaten Rembang' }}
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
                            <p>{{ $booking->bookings->packages->name }}</p>
                            <p class="item-price">Rp
                                {{ number_format($booking->bookings->packages->harga, 0, ',', '.') }}</p>
                        </td>
                        <td>
                            <h6 class="text-primary label-title">Estimate Event Date :</h6>
                            <h6>{{ Carbon::parse($booking->bookings->tanggal)->locale('id')->translatedFormat('l, j F Y') }}
                            </h6>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h6 class="text-primary label-title">Payment Type :</h6>
                            <p>{{ $booking->bookings->payment_type == 'full' ? 'Full Payment' : 'DP' }}</p>
                            <p class="item-price">Rp {{ number_format($booking->bookings->total_harga, 0, ',', '.') }}
                            </p>

                            <br>

                            @if ($booking->bookings->payment_type == 'dp')
                                <h6 class="text-primary label-title">Total Pelunasan :</h6>
                                <p class="item-price">Rp
                                    {{ number_format($booking->bookings->sisa_harga, 0, ',', '.') }}
                                </p>
                            @endif
                        </td>
                        <td>
                            <h6 class="text-primary label-title">Status Payment :</h6>
                            <h6 id="text-confirm">TELAH DI KONFIRMASI VALID</h6>
                        </td>
                    </tr>
                </table>




                @if ($booking->bookings->payment_type == 'dp')
                    <div class="text-center" style="margin-top: 20px; color: red;">
                        <p>Pelunasan Pembayaran Photoshoot maksimal H+7 setelah acara. Seluruh File foto dapat
                            diakses setelah pembayaran Lunas.</p>
                    </div>
                @endif

                <div class="row-details">
                    <div class="col-6 col-details">
                        <div class="card-body">
                            <h6 class="text-primary">Detail Location:</h6>
                            <p>{{ $booking->bookings->location }}</p>
                        </div>
                    </div>
                    <div class="col-6 col-details">
                        <div class="card-body">
                            <h6 class="text-primary">Photoshoot Concept:</h6>
                            <p>{{ $booking->bookings->concept }}</p>
                        </div>
                    </div>
                </div>
                <div class="signature-container">
                    <div class="signature">
                        <p style="margin-bottom: 10px;">
                            {{ Carbon::parse($booking->updated_at)->locale('id')->translatedFormat('l, j F Y') }}</p>
                        <h6 class="text-primary">Confirmed by</h6>
                        <p>{{ ucwords(Auth::user()->name) }}
                        </p>
                    </div>
                </div>


                <div class="text-center mt-4" style="margin-top: 10px;">
                    <p>Jika ada pertanyaan silahkan WhatsApp Admin <br>Thank You :)</p>
                </div>

                {{-- <a href="{{ route('admin_panel.downloadPDF', $booking->id) }}" class="btn btn-primary">Download
                    PDF</a> --}}

            </div>
        </div>
    </div>
</body>

</html>
