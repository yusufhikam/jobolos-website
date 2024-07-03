<!DOCTYPE html>
<html>

<head>
    <title>Invoice</title>
</head>

<body>
    <h1>Hello, {{ $rentalBooking->rentals->users->name }} !</h1>
    <p>Terima kasih telah memilih kami untuk mengabadikan momen berharga Anda. Dibawah terlampir invoice untuk
        Rental Kamera Anda.</p>
    <p>Harap simpan dan tunjukkan INVOICE ini ketika akan mengambil Unit Kamera kami</p>
    <p>Booking Code: RC-{{ $rentalBooking->rentals->id, 4, '0', STR_PAD_LEFT }}-{{ $rentalBooking->rentals->count() }}
    </p>

    <h4>Detail Rental Kamera : </h4>
    <p>Camera: {{ $rentalBooking->rentals->cameras->camera_types->brands->name }}
        {{ $rentalBooking->rentals->cameras->name }}
    </p>
    <p>Lensa : {{ $rentalBooking->rentals->lenses->name }}</p>
    <p>Harga Rental Kamera/hari : Rp {{ number_format($rentalBooking->rentals->cameras->harga_per_hari, 0, ',', '.') }}
    </p>
    <p>Harga Rental Lensa/hari : Rp {{ number_format($rentalBooking->rentals->lenses->harga_per_hari, 0, ',', '.') }}</p>
    <p>Total Pembayaran: Rp {{ number_format($rentalBooking->rentals->total_harga, 0, ',', '.') }}</p>

    <p>Silahkan hubungi WhatsApp kami jika ada pertanyaan lebih lanjut.</p>
</body>

</html>
