<!DOCTYPE html>
<html>

<head>
    <title>Invoice</title>
</head>

<body>
    <h1>Hello, {{ $booking->bookings->users->name }} !</h1>
    <p>Terima kasih telah memilih kami untuk mengabadikan momen berharga Anda. Dibawah terlampir invoice untuk
        pemotretan Anda.</p>
    <p>Booking Code: PS-{{ $booking->bookings->id, 4, '0', STR_PAD_LEFT }}-{{ $booking->bookings->count() }}</p>
    <p>Nama Paket: {{ $booking->bookings->packages->name }}
        [ Rp {{ number_format($booking->bookings->packages->harga, 0, ',', '.') }} ]</p>
    <p>Lokasi : @if ($booking->bookings->location_type == 'other')
            Luar Kota
        @else
            Kabupaten Rembang
        @endif
    </p>
    <p>Tipe Pembayaran: @if ($booking->bookings->payment_type == 'dp')
            DP
        @else
            Full Payment
        @endif
    </p>
    <p>Total Harga: Rp {{ number_format($booking->bookings->total_harga, 0, ',', '.') }}</p>
    @if ($booking->bookings->location_type == 'other')
        <p>Biaya Tambahan untuk Luar Kota: Rp 250.000</p>
    @endif

    @if ($booking->bookings->payment_type == 'dp')
        <p>Total Pelunasan : Rp {{ number_format($booking->bookings->sisa_harga, 0, ',', '.') }}</p>

        <p>Anda dapat mengakses Foto ketika sudah melakukan Pelunasan. Pelunasan maksimal H+7 setelah acara berlangsung.
        </p>
    @endif

    <p>Silahkan hubungi WhatsApp kami jika ada pertanyaan lebih lanjut.</p>
</body>

</html>
