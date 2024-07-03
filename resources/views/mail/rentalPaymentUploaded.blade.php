<!DOCTYPE html>
<html>

<head>
    <title>Payment Proof Uploaded</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1 class="my-4">Payment Proof Uploaded</h1>
        <p>Dear Admin,</p>
        <p>A new payment proof has been uploaded from booking :</p>
        <div class="responsive-table">

            <table class="table table-bordered">
                <tr>
                    <th class="text-left">Customer Name</th>
                    <td class="text-left">{{ $user->name }}</td>
                </tr>
                <tr>
                    <th class="text-left">WhatsApp</th>
                    <td class="text-left">{{ $user->no_telp }}</td>
                </tr>
                <tr>
                    <th class="text-left">Camera</th>
                    <td class="text-left">{{ $booking->cameras->camera_types->brands->name }}
                        {{ $booking->cameras->name }}</td>
                </tr>
                <tr>
                    <th class="text-left">Lens</th>
                    <td class="text-left">{{ $booking->lenses->name }} [ {{ $booking->cameras->camera_types->name }} ]
                    </td>
                </tr>
                <tr>
                    <th class="text-left">Rental Date</th>
                    <td class="text-left">{{ \Carbon\Carbon::parse($booking->tgl_sewa)->translatedFormat('d F Y') }}
                    </td>
                </tr>
                <tr>
                    <th class="text-left">Return Date</th>
                    <td class="text-left">{{ \Carbon\Carbon::parse($booking->tgl_kembali)->translatedFormat('d F Y') }}
                    </td>
                </tr>
                <tr>
                    <th class="text-left">Guarantee</th>
                    <td class="text-left">{{ $booking->jaminan }}</td>
                </tr>
                <tr>
                    <th class="text-left">Total Payment</th>
                    <td class="text-left">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</td>
                </tr>
                <!-- Tambahkan detail lain sesuai kebutuhan -->
            </table>
        </div>
        <p class="text-left">Please view the payment proof on website and confirm the booking soon.</p>
    </div>
</body>

</html>
