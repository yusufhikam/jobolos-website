<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RentalBookingReceived extends Controller
{
    public function index(Request $request)
    {
        Carbon::setLocale('id'); // Mengatur lokal Carbon ke bahasa Indonesia

        // keyword yang dimasukkan pada form cari
        $keyword = $request->keyword;

        // filter data berdasarkan status rental
        $statusFiltering = $request->status;

        $rentals = Rental::with([
            'users',
            'cameras',
            'cameras.camera_types',
            'cameras.camera_types.brands',
            'lenses', 'lenses.camera_types'
        ])
            ->when($keyword, function ($query) use ($keyword) {
                $query->whereHas('users', function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('email', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('no_telp', 'LIKE', '%' . $keyword . '%');
                })
                    ->orWhereHas('cameras', function ($query) use ($keyword) {
                        $query->where('name', 'LIKE', '%' . $keyword . '%');
                    })
                    ->orWhereHas('lenses', function ($query) use ($keyword) {
                        $query->where('name', 'LIKE', '%' . $keyword . '%');
                    })
                    ->orWhere(function ($query) use ($keyword) {
                        $query->where('tgl_sewa', 'LIKE', '%' . $keyword . '%')
                            ->orWhere('tgl_kembali', 'LIKE', '%' . $keyword . '%')
                            ->orWhere('jaminan', 'LIKE', '%' . $keyword . '%')
                            ->orWhere('total_harga', 'LIKE', '%' . $keyword . '%');
                    })
                    ->orWhere(function ($query) use ($keyword) {
                        // Pencarian berdasarkan status pembayaran
                        $statuses = [
                            'menunggu pembayaran' => 'pending',
                            'menunggu konfirmasi' => 'waiting',
                            'kamera sedang disewa' => 'active',
                            'kamera sudah dikembalikan' => 'completed'
                        ];

                        if (isset($statuses[strtolower($keyword)])) {
                            $query->where('status', $statuses[strtolower($keyword)]);
                        }
                    });
            })
            ->when($statusFiltering, function ($query) use ($statusFiltering) {
                $query->where('status', $statusFiltering);
            })
            ->orderBy('updated_at', 'desc')
            ->orderBy('created_at', 'asc')
            ->paginate(6);

        $alert = null;
        if ($rentals->isEmpty()) {
            if ($keyword != $rentals) {
                $alert = "Tidak ada data yang ditemukan untuk kata kunci: $keyword.";
            }

            $alert = "Tidak Ada Data";
        }
        return view('/admin_panel/adminManageBookingReceivedRental', compact('rentals', 'keyword', 'alert'));
    }
}
