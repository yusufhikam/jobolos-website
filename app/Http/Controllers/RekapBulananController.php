<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Rental;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RekapBulananController extends Controller
{
    // METHOD UNTUK MENAMPILKAN REKAP BULANAN PHOTOSHOOT
    public function show(Request $request)
    {
        Carbon::setLocale('id');
        // untuk mengambil data bulan dan tahun dari request, default today
        $month = $request->input('month', date('m'));
        $year = $request->input('year', date('Y'));

        // Mendapatkan nama bulan dalam Bahasa Indonesia
        $monthName = Carbon::createFromFormat('m', $month)->translatedFormat('F');

        // mengambil data booking berdasarkan tahun dari request
        $booking = Booking::whereYear('tanggal', $year)
            ->whereMonth('tanggal', $month)
            ->get();
        return view('/admin_panel/rekapPhotoshoot', compact('booking', 'month', 'year', 'monthName'));
    }

    // METHOD UNTUK MENAMPILKAN REKAP BULANAN PENYEWAAN KAMERA

    public function show_rental(Request $request)
    {
        Carbon::setLocale('id');
        // untuk mengambil data bulan dan tahun dari request, default today
        $month = $request->input('month', date('m'));
        $year = $request->input('year', date('Y'));

        // Mendapatkan nama bulan dalam Bahasa Indonesia
        $monthName = Carbon::createFromFormat('m', $month)->translatedFormat('F');

        // mengambil data booking berdasarkan tahun dari request
        $booking = Rental::whereYear('tgl_sewa', $year)
            ->whereMonth('tgl_sewa', $month)
            ->orWhere(function ($query) use ($year, $month) {
                $query->whereYear('tgl_kembali', $year)
                    ->whereMonth('tgl_kembali', $month);
            })
            ->get();
        return view('/admin_panel/rekapRental', compact('booking', 'month', 'year', 'monthName'));
    }

    public function getIndoMonth($month)
    {
        $monthNames = array(
            'January' => 'Januari',
            'February' => 'Februari',
            'March' => 'Maret',
            'April' => 'April',
            'May' => 'Mei',
            'June' => 'Juni',
            'July' => 'Juli',
            'August' => 'Agustus',
            'September' => 'September',
            'October' => 'Oktober',
            'November' => 'November',
            'December' => 'Desember',
        );

        return $monthNames[date_format($month, 'F')];
    }
}
