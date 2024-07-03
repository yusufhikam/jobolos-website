<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingReceivedController extends Controller
{
    public function index(Request $request)
    {
        Carbon::setLocale('id'); // Mengatur lokal Carbon ke bahasa Indonesia

        $keyword = $request->keyword;

        $status_bayar_filtering = $request->status_pembayaran;

        $booking = Booking::with(['users', 'packages'])
            // ->where('status_pembayaran', 'pending')
            ->where(function ($query) use ($keyword) {
                $query->whereHas('users', function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('email', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('no_telp', 'LIKE', '%' . $keyword . '%');
                })
                    ->orWhereHas('packages', function ($subQuery) use ($keyword) {
                        $subQuery->where('name', 'LIKE', '%' . $keyword . '%');
                    })
                    ->orWhere('location_type', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('location', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('concept', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('tanggal', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('total_harga', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('payment_type', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('status_pembayaran', 'LIKE', '%' . $keyword . '%');

                // Pencarian berdasarkan tanggal (dd month)
                if (preg_match('/^\d{1,2}\s+[a-z]+$/i', $keyword)) {
                    // Pisahkan tanggal dan bulan dari keyword
                    [$day, $monthName] = explode(' ', $keyword, 2);

                    // Ubah bulan dalam bahasa Indonesia menjadi angka
                    $bulanIndonesia = [
                        'januari' => 1,
                        'februari' => 2,
                        'maret' => 3,
                        'april' => 4,
                        'mei' => 5,
                        'juni' => 6,
                        'juli' => 7,
                        'agustus' => 8,
                        'september' => 9,
                        'oktober' => 10,
                        'november' => 11,
                        'desember' => 12
                    ];

                    $monthNumber = $bulanIndonesia[strtolower($monthName)];

                    // Ubah format tanggal ke format MySQL date (YYYY-MM-DD)
                    $date = Carbon::create(null, $monthNumber, $day)->toDateString();

                    $query->orWhere('tanggal', 'LIKE', '%' . $date . '%');
                }
            })
            ->when($status_bayar_filtering, function ($query) use ($status_bayar_filtering) {
                $query->where('status_pembayaran', $status_bayar_filtering);
            })
            ->orderBy('updated_at', 'desc');

        // // Array bulan dalam bahasa Indonesia
        // $bulanIndonesia = [
        //     'januari' => 1,
        //     'februari' => 2,
        //     'maret' => 3,
        //     'april' => 4,
        //     'mei' => 5,
        //     'juni' => 6,
        //     'juli' => 7,
        //     'agustus' => 8,
        //     'september' => 9,
        //     'oktober' => 10,
        //     'november' => 11,
        //     'desember' => 12
        // ];

        // keyword status pembayaran
        $statusBayar = [
            'batal' => ['cancelled'],
            'dibatal' => ['cancelled'],
            'dibatalkan' => ['cancelled'],
            'telah' => ['completed'],
            'pembayaran' => ['pending', 'completed'],
            'menunggu pembayaran' => ['pending'],
            'menunggu' => ['pending', 'completed'],
            'menunggu konfirmasi' => ['completed'],
            'bayar' => ['completed', 'pending'],
            'telah dibayar' => ['completed'],
            'dibayar' => ['completed'],
            'konfirmasi' => ['completed'],
        ];

        // untuk pencarian yang spesifik / tidak ada di database yang ditampilkan di view

        if (strtolower($keyword) == 'luar kota') {
            $booking = $booking->orWhere('location_type', '!=', 'rembang');
        } elseif (strtolower($keyword) == 'dibatalkan') {
            $booking = $booking->orWhere('status_pembayaran', 'cancelled');
        } elseif (strtolower($keyword) == 'menunggu pembayaran') {
            $booking = $booking->orWhere('status_pembayaran', 'pending');
        } elseif (strtolower($keyword) == 'Telah Dibayar & Menunggu Konfirmasi') {
            $booking = $booking->orWhere('status_pembayaran', 'completed');
        } elseif (strtolower($keyword) == 'full payment') {
            $booking = $booking->orWhere('payment_type', 'full');
        } elseif (strtolower($keyword) == 'dp') {
            $booking = $booking->orWhere('payment_type', 'dp');
        }
        // elseif (array_key_exists(strtolower($keyword), $bulanIndonesia)) {
        //     $monthNumber = $bulanIndonesia[strtolower($keyword)];
        //     $booking = $booking->orWhereMonth('tanggal', $monthNumber);
        // }
        elseif (array_key_exists($keyword, $statusBayar)) {
            $booking = $booking->orWhereIn('status_pembayaran', $statusBayar[$keyword]);
        }


        // $booking = $booking->when($status_bayar_filtering, function ($query) use ($status_bayar_filtering) {
        //     return $query->where('status_pembayaran', $status_bayar_filtering);
        // });

        $booking = $booking->paginate(5);

        // Cek apakah ada data yang ditemukan
        $alert = null;
        if ($booking->isEmpty()) {
            if ($keyword != $booking) {
                $alert = "Tidak ada data yang ditemukan untuk kata kunci: $keyword.";
            }

            $alert = "Tidak Ada Data";
        }



        return view('/admin_panel/adminManageBookingReceived', compact('booking', 'alert'));
    }
}