<!DOCTYPE html>
<html>

<head>
    <title>Booking Notification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1 class="my-4">New Booking Received</h1>
        <p>Dear Admin,</p>
        <p>A new booking has been made with the following details:</p>
        <div class="responsive-table">

            <table class="table table-bordered">
                <tr>
                    <th>User Name</th>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <th>Package Name</th>
                    <td>{{ $package->name }}</td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td>{{ \Carbon\Carbon::parse($bookingData['tanggal'])->translatedFormat('d F Y') }}</td>
                </tr>
                <tr>
                    <th>Location Type</th>
                    <td>{{ $bookingData['location_type'] == 'other' ? 'Luar Kota' : 'Kabupaten Rembang' }}</td>
                </tr>
                <tr>
                    <th>Location</th>
                    <td>{{ $bookingData['location'] }}</td>
                </tr>
                <tr>
                    <th>Concept</th>
                    <td>{{ $bookingData['concept'] }}</td>
                </tr>
                <tr>
                    <th>Payment Type</th>
                    <td>{{ $bookingData['payment_type'] == 'dp' ? 'DP' : 'Full Payment' }}</td>
                </tr>
                <tr>
                    <th>Total Price</th>
                    <td>Rp {{ number_format($bookingData['total_harga'], 0, ',', '.') }}</td>
                </tr>
            </table>
        </div>
        <p>Please take necessary actions.</p>
    </div>
</body>

</html>
