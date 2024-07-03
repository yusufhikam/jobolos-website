<!DOCTYPE html>
<html>

<head>
    <title>Rental Camera Booking Notification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1 class="my-4">New Rental Booking Received</h1>
        <p>Dear Admin,</p>
        <p>A new rental booking has been made with the following details:</p>
        <div class="responsive-table">
            <table class="table table-bordered">
                <tr>
                    <th>User Name</th>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <th>Camera Name</th>
                    <td>{{ $camera->name }}</td>
                </tr>
                <tr>
                    <th>Lens Name</th>
                    <td>{{ $lens->name }}</td>
                </tr>
                <tr>
                    <th>Tanggal Sewa</th>
                    <td>{{ \Carbon\Carbon::parse($bookingData['tgl_sewa'])->translatedFormat('d F Y') }}</td>
                </tr>
                <tr>
                    <th>Tanggal Kembali</th>
                    <td>{{ \Carbon\Carbon::parse($bookingData['tgl_kembali'])->translatedFormat('d F Y') }}</td>
                </tr>
                <tr>
                    <th>Total Payment</th>
                    <td>Rp {{ number_format($bookingData['total_harga'], 0, ',', '.') }}</td>
                </tr>
            </table>
        </div>
        <p>Please take necessary actions.</p>
    </div>
</body>

</html>
