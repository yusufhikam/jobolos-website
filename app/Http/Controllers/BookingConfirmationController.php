<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceMail;
use App\Models\Booking;
use App\Models\Invoice;
use App\Models\Payment;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Dompdf\Dompdf;
// use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class BookingConfirmationController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $status_bayar_filtering = $request->status;


        // Memulai query dengan eager loading relationships
        $payments = Payment::with(['bookings', 'bookings.users', 'bookings.packages']);

        // Pencarian
        if ($keyword) {
            $keywordLower = strtolower($keyword);

            $payments->where(function ($query) use ($keyword, $keywordLower) {
                $query->whereHas('bookings.users', function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('email', 'LIKE', '%' . $keyword . '%')
                        ->orWhere('no_telp', 'LIKE', '%' . $keyword . '%');
                })
                    ->orWhereHas('bookings.packages', function ($subQuery) use ($keyword) {
                        $subQuery->where('name', 'LIKE', '%' . $keyword . '%');
                    })
                    ->orWhereHas('bookings', function ($subQuery2) use ($keyword) {
                        $subQuery2->where('location_type', 'LIKE', '%' . $keyword . '%')
                            ->orWhere('payment_type', 'LIKE', '%' . $keyword . '%');
                    });

                // Pencarian berdasarkan kondisi khusus
                if ($keywordLower == 'luar kota') {
                    $query->orWhereHas('bookings', function ($qr) {
                        $qr->where('location_type', '!=', 'rembang');
                    });
                } elseif ($keywordLower == 'full payment') {
                    $query->orWhereHas('bookings', function ($qr) {
                        $qr->where('payment_type', 'full');
                    });
                } elseif ($keywordLower == 'dp') {
                    $query->orWhereHas('bookings', function ($qr) {
                        $qr->where('payment_type', 'dp');
                    });
                } else {
                    $statusBayar = [
                        'tolak' => ['rejected'],
                        'telah' => ['completed'],
                        'telah dikonfirmasi' => ['completed'],
                        'konfirmasi' => ['completed', 'pending'],
                        'dikonfirmasi' => ['completed', 'pending'],
                        'perlu' => ['pending'],
                        'perlu dikonfirmasi' => ['pending'],
                    ];

                    if (array_key_exists($keywordLower, $statusBayar)) {
                        $query->orWhereIn('status', $statusBayar[$keywordLower]);
                    }
                }
            });
        }

        // Filtering by status
        if ($status_bayar_filtering) {
            $payments->where('status', $status_bayar_filtering);
        }

        // Paginate
        $payments = $payments->orderBy('updated_at', 'desc')->paginate(5);

        $alert = null;
        if ($payments->isEmpty()) {
            if ($keyword != $payments) {
                $alert = "Tidak ada data yang ditemukan untuk kata kunci: $keyword.";
            }

            $alert = "Tidak Ada Data";
        }

        return view('/admin_panel/adminManageBookingConfirmation', compact('payments', 'alert'));
    }

    // admin konfirmasi bukti pembayaran valid atau tidak
    public function approve($id)
    {

        $payments = Payment::findOrFail($id);

        $payments->update([
            'status' => 'Approved'
        ]);

        // membuat dan mengirim invoice booking ke customer
        $this->generateInvoice($payments);

        Alert::success('Berhasil!', 'Pembayaran telah dikonfirmasi & INVOICE akan dikirim ke Email Customer');

        return redirect('admin_panel/adminManageBookingConfirmation');
    }

    private function generateInvoice($payments)
    {
        $booking = $payments;

        if (!$booking) {
            throw new \Exception('Booking Photoshoot tidak ditemukan');
        }
        // membuat file pdf dan mengirimkan ke email customer
        $pdf = PDF::loadView('invoices.photoshoot_invoices.invoice', compact('booking'));
        // $pdf = PDF::loadView('invoices.photoshoot_invoices.invoice', compact('booking'));

        // menyimpan file invoice pdf ke directory storage
        $fileName = 'Invoice_' . $booking->bookings->id . '_' . $booking->bookings->users->name . '.pdf';
        $filePath = 'invoices/photoshoot_invoices/' . $fileName;
        Storage::put($filePath, $pdf->output());

        // menyimpan data invoice ke dalam database
        $invoice = Invoice::create([
            'booking_id' => $booking->bookings->id,
            'invoice_name' => $fileName,
        ]);

        // mengirim email ke customer
        Mail::to($booking->bookings->users->email)->send(new InvoiceMail($invoice, $filePath, $booking));

        return $invoice;
    }

    // admin menolak pembayaran karena bukti pembayaran tidak valid
    public function rejected($id)
    {
        $payments = Payment::findOrFail($id);

        $payments->update([
            'status' => 'rejected'
        ]);

        Alert::warning('Warning!', 'Anda Telah Menolak pembayaran tersebut karena bukti pembayaran tidak valid');

        return redirect('/admin_panel/adminManageBookingConfirmation');
    }

    public function detail_confirmed($id, $name)
    {

        $payments = Payment::with(['bookings.users', 'bookings.packages'])->findOrFail($id);

        // $codeBooking = $payments->bookings->count();

        // $formatTanggal = Carbon::parse($payments->bookings->tanggal)->locale('id')->translatedFormat('l, j F Y');

        return view('/admin_panel/admin-detail-confirmed-booking-payment', compact('payments'));
        // return view('/admin_panel/partials/detailBookingConfirmed2', compact('payments'));
    }

    // method untuk download file PDF dari detail_confirmed()
    public function downloadPDF($id)
    {
        $payments = Payment::with(['bookings.users', 'bookings.packages'])->find($id);
        // $codeBooking = $payments->bookings->count();
        // $formatTanggal = Carbon::parse($payments->bookings->tanggal)->locale('id')->translatedFormat('l, j F Y');

        $html = view('/admin_panel/partials/detailBookingConfirmed', compact('payments'))->render();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('a4', 'portrait');
        $dompdf->render();

        $pdf = $dompdf->output();

        return response()->make($pdf, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="detail_confirmed_photoshoot_booking.pdf"',
        ]);

        // return $pdf->download('detail_confirmed_photoshoot_booking.pdf');
    }
}