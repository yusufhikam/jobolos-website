<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadBuktiPembayaranRequest;
use App\Mail\PaymentUploadedNotification;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\User;
use App\Notifications\PaymentNotification;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentController extends Controller
{
    public function uploadBukti(UploadBuktiPembayaranRequest $request, $id)
    {

        $booking = Booking::findOrFail($id);

        // upload bukti foto
        if ($request->file('bukti_pembayaran')) {
            // membuat nama file dan mempertahankan ekstensi file
            $extension = $request->file('bukti_pembayaran')->getClientOriginalExtension();
            $newName = 'Bukti_Pembayaran_' . Auth::user()->name . '_' . now()->timestamp . '.' . $extension;

            // menyimpan foto ke dalam directory
            $request->file('bukti_pembayaran')->storeAs('/admin_assets/buktiPembayaran/bukti_pembayaran_photoshoot', $newName, 'public');
            // menyimpan file foto dengan nama baru
            $request['bukti_pembayaran'] = $newName;

            // update status pada table payments menjadi pending
            $payment = Payment::create([
                'booking_id' => $booking->id,
                'bukti_pembayaran' => $newName,
                'status' => 'pending',
            ]);

            // update status_pembayaran pada table bookings
            $booking->update([
                'status_pembayaran' => 'completed',
            ]);

            $message = "<b>" . Auth::user()->name . "</b> telah mengupload bukti pembayaran. Mohon segera cek dan konfirmasi";
            $admin = User::where('role_id', 1)->first();
            $admin->notify(new PaymentNotification($booking, $message));

            // Kirim notifikasi email ke admin
            $admins = User::whereHas('nama_role', function ($query) {
                $query->where('name', 'admin');
            })->get();

            foreach ($admins as $admin) {
                Mail::to($admin->email)->send(new PaymentUploadedNotification($booking, Auth::user()));
            }
        }

        Alert::success('Berhasil!', 'Bukti Pembayaran Anda telah kami terima, silahkan tunggu konfirmasi admin untuk mendapatkan INVOICE !');

        return redirect('/jobolos/transactions');
    }

    public function updateBukti(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        // $fileName = $booking->payments->bukti_pembayaran;

        // cek apakah ada file foto sebelumnya
        if ($request->hasFile('bukti_pembayaran')) {
            // membuat nama file dan mempertahankan ekstensi file
            $extension = $request->file('bukti_pembayaran')->getClientOriginalExtension();
            $newName = 'Bukti_Pembayaran_' . Auth::user()->name . '_' . now()->timestamp . '.' . $extension;

            // menyimpan foto ke dalam directory
            $request->file('bukti_pembayaran')->storeAs('/admin_assets/buktiPembayaran/bukti_pembayaran_photoshoot', $newName, 'public');
            // menyimpan file foto dengan nama baru
            $request['bukti_pembayaran'] = $newName;

            // hapus file lama dari data booking dengan id tertentu

            foreach ($booking->payments as $payment) {
                Storage::disk('public')->delete('/admin_assets/bukti_pembayaran_photoshoot' . $payment->bukti_pembayaran);
                // update bukti pembayaran  dan update status payment  menjadi pending
                $payment->update([
                    'bukti_pembayaran' => $newName,
                    'status' => 'pending',
                ]);
            }
        }

        Alert::success('Berhasil!', 'Bukti Pembayaran Anda telah di Update, silahkan tunggu konfirmasi admin untuk mendapatkan INVOICE !');
        return redirect('/jobolos/transactions');
    }
}