<?php

namespace App\Http\Controllers;

use App\Mail\RentalInvoiceMail;
use App\Models\Rental;
use App\Models\RentalInvoice;
use App\Models\RentalPayment;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class RentalBookingConfirmationController extends Controller
{
    public function index(Request $request)
    {
        Carbon::setLocale('id'); // Mengatur lokal Carbon ke bahasa Indonesia

        // keyword yang dimasukkan pada form cari
        $keyword = $request->keyword;

        // filter data berdasarkan status rental
        $statusFiltering = $request->status_pembayaran;

        $payments = RentalPayment::with([
            'rentals',
            'rentals.users',
            'rentals.cameras',
            'rentals.cameras.camera_types',
            'rentals.cameras.camera_types.brands',
            'rentals.lenses',
            'rentals.lenses.camera_types'
        ])
            ->when($keyword, function ($query) use ($keyword) {
                $query->whereHas('rentals.users', function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('email', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('no_telp', 'LIKE', '%' . $keyword . '%');
                })
                    ->orWhereHas('rentals.cameras', function ($query) use ($keyword) {
                        $query->where('name', 'LIKE', '%' . $keyword . '%');
                    })
                    ->orWhereHas('rentals.cameras.camera_types', function ($query) use ($keyword) {
                        $query->where('name', 'LIKE', '%' . $keyword . '%');
                    })
                    ->orWhereHas('rentals.cameras.camera_types.brands', function ($query) use ($keyword) {
                        $query->where('name', 'LIKE', '%' . $keyword . '%');
                    })
                    ->orWhereHas('rentals.lenses', function ($query) use ($keyword) {
                        $query->where('name', 'LIKE', '%' . $keyword . '%');
                    })
                    ->orWhereHas('rentals', function ($query) use ($keyword) {
                        $query->where('tgl_sewa', 'LIKE', '%' . $keyword . '%')
                            ->orWhere('tgl_kembali', 'LIKE', '%' . $keyword . '%')
                            ->orWhere('jaminan', 'LIKE', '%' . $keyword . '%')
                            ->orWhere('total_harga', 'LIKE', '%' . $keyword . '%');
                    })
                    ->orWhere(function ($query) use ($keyword) {
                        // Pencarian berdasarkan status pembayaran
                        $statuses = [
                            'perlu dikonfirmasi' => 'pending',
                            'telah dikonfirmasi' => 'approved',
                            'tolak' => 'rejected',
                        ];

                        if (isset($statuses[strtolower($keyword)])) {
                            $query->where('status_pembayaran', $statuses[strtolower($keyword)]);
                        }
                    });
            })
            ->when($statusFiltering, function ($query) use ($statusFiltering) {
                $query->where('status_pembayaran', $statusFiltering);
            })->paginate(6);

        $alert = null;
        if ($payments->isEmpty()) {
            if ($keyword != $payments) {
                $alert = "Tidak ada data yang ditemukan untuk kata kunci: $keyword.";
            }

            $alert = "Tidak Ada Data";
        }
        return view('/admin_panel/adminManageBookingConfirmationRental', compact('payments', 'keyword', 'alert'));
    }

    public function approve($id)
    {
        $rentalPayment = RentalPayment::with('rentals')->findOrFail($id);

        $rentalPayment->update([
            'status_pembayaran' => 'approved',
        ]);

        $rentalPayment->rentals->update([
            'status' => 'active',
        ]);

        // membuat dan mengirim invoice ke customer
        $this->generateInvoice($rentalPayment);

        Alert::success('Berhasil!', 'Pembayaran telah dikonfirmasi & INVOICE akan dikirm ke Email Customer');
        return redirect('/admin_panel/adminManageBookingConfirmationRental');
    }

    private function generateInvoice($rentalPayment)
    {
        $rentalBooking = $rentalPayment;

        if (!$rentalBooking) {
            throw new \Exception('Booking Rental Kamera tidak ditemukan');
        }

        // membuat file pdf dan mengirimkan ke email customer
        $pdf = PDF::loadView('invoices.rental_camera_invoices.invoice', compact('rentalBooking'));

        // menyimpan file invoice pdf ke directory storage
        $fileName = 'Invoice_' . $rentalBooking->rentals->id . '_' . $rentalBooking->rentals->users->name . '.pdf';
        $filePath = 'invoices/rental_camera_invoices/' . $fileName;
        Storage::put($filePath, $pdf->output());

        // menyimpan data invoice ke dalam database
        $rentalInvoice = RentalInvoice::create([
            'rental_id' => $rentalBooking->rentals->id,
            'invoice_name' => $fileName,
        ]);

        // mengirim invoice ke email customer
        Mail::to($rentalBooking->rentals->users->email)->send(new RentalInvoiceMail($rentalInvoice, $filePath, $rentalBooking));

        return $rentalInvoice;
    }

    // method untuk menolak bukti pembayaran
    public function rejected($id)
    {
        $rentalPayment = RentalPayment::findOrFail($id);

        $rentalPayment->update([
            'status_pembayaran' => 'rejected',
        ]);

        Alert::warning('Warning!', 'Anda Telah Menolak pembayaran tersebut karena bukti pembayaran tidak valid');

        return redirect('/admin_panel/adminManageBookingConfirmationRental');
    }

    // method untuk mengupdate status rentals menjadi 'completed'
    public function completed($id)
    {

        $statusRental = Rental::findOrFail($id);

        $statusRental->update([
            'status' => 'completed',
        ]);

        Alert::success('Penyewaan Selesai!', 'Status Ketersediaan Kamera telah diperbarui');

        return redirect('/admin_panel/adminManageBookingConfirmationRental');
    }
}