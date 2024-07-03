<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadBuktiPembayaranRentalKameraRequest;
use App\Mail\RentalPaymentUploadedNotification;
use App\Models\Payment;
use App\Models\Rental;
use App\Models\RentalPayment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentRentalCameraController extends Controller
{



    // UPLOAD BUKTI PEMBAYARAN
    public function uploadBukti(UploadBuktiPembayaranRentalKameraRequest $request, $id)
    {
        $booking = Rental::findOrFail($id);

        // upload bukti foto
        if ($request->file('bukti_pembayaran')) {
            // membuat nama file dan mempertahankan ekstensi file
            $extension = $request->file('bukti_pembayaran')->getClientOriginalExtension();
            $newName = 'Bukti_pembayaran_' . Auth::user()->name . '_' . now()->timestamp . '.' . $extension;

            // menyimpan foto ke dalam directory
            $request->file('bukti_pembayaran')->storeAs('/admin_assets/buktiPembayaran/bukti_pembayaran_rental_camera', $newName, 'public');
            // menyimpan file foto dengan nama baru $newName
            $request['bukti_pembayaran'] = $newName;

            // update status pembayaran pada table rental_payments
            $rentalPayments = RentalPayment::create([
                'rental_id' => $booking->id,
                'bukti_pembayaran' => $newName,
                'status_pembayaran' => 'pending',
            ]);

            // update status pada table rentals menjadi active (penyewaan dimulai secara resmi setelah melakukan pembayaran)
            $booking->update([
                'status' => 'waiting',
            ]);

            // Kirim notifikasi email ke admin
            $admins = User::whereHas('nama_role', function ($query) {
                $query->where('name', 'admin');
            })->get();

            foreach ($admins as $admin) {
                Mail::to($admin->email)->send(new RentalPaymentUploadedNotification($booking, Auth::user()));
            }
        }

        Alert::success('Berhasil!', 'Bukti Pembayaran Anda telah kami terima, silahkan tunggu konfirmasi admin untuk mendapatkan INVOICE !');

        return redirect('/jobolos/rental-transactions');
    }
}
