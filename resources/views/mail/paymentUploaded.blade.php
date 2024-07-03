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
                {{-- <tr>
                    <th>Booking ID</th>
                    <td>{{ $booking->id }}</td>
                </tr> --}}
                <tr>
                    <th class="text-left">Customer Name</th>
                    <td class="text-left">{{ $user->name }}</td>
                </tr>
                <tr>
                    <th class="text-left">WhatsApp</th>
                    <td class="text-left">{{ $user->no_telp }}</td>
                </tr>
                <tr>
                    <th class="text-left">Booking Date</th>
                    <td class="text-left">{{ \Carbon\Carbon::parse($booking->tanggal)->translatedFormat('d F Y') }}</td>
                </tr>
                <tr>
                    <th class="text-left">Location</th>
                    <td class="text-left">
                        @if ($booking->location_type == 'other')
                            Luar Kota
                        @else
                            Kabupaten Rembang
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="text-left">Payment Type</th>
                    <td class="text-left">
                        @if ($booking->payment_type == 'dp')
                            DP
                        @else
                            Full Payment
                        @endif
                    </td>
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
