<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateDateRequest;
use App\Models\BankAccount;
use App\Models\Booking;
use App\Models\Rental;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class TransactionController extends Controller
{
    // menampilkan daftar transaksi photoshoot booking
    public function index()
    {
        Carbon::setLocale('id'); // Mengatur lokal Carbon ke bahasa Indonesia

        $transaction = Booking::with(['packages', 'payments'])
            ->where('user_id', auth()->id())
            ->where(function ($query) {
                $query->where('status_pembayaran', 'pending')
                    ->orWhereHas('payments', function ($subQuery) {
                        $subQuery->Where('status', 'pending')
                            ->orWhere('status', 'rejected');
                    });
            })
            ->orderBy('created_at', 'desc')->get();

        // $payment = Booking::with('payments')->where('status', 'approved')->count() > 0;

        $hasApprovedPayment = $transaction->pluck('payments')->flatten()->contains('status', 'approved');

        // bank account
        $bankAccounts = BankAccount::all();

        // dd($transaction);
        $codeBooking = Booking::count();

        return view('frontend.transactions', compact('transaction', 'codeBooking', 'hasApprovedPayment', 'bankAccounts'));
    }

    // menampilkan data riwayat transaksi photoshoot booking
    public function show()
    {
        Carbon::setLocale('id'); // Mengatur lokal Carbon ke bahasa Indonesia

        $transaction = Booking::with(['packages', 'payments'])
            ->where('user_id', auth()->id())
            ->where(function ($query) {
                $query->where('status_pembayaran', 'cancelled')
                    ->orWhereHas('payments', function ($subQuery) {
                        $subQuery->Where('status', 'approved');
                    });
            })
            ->orderBy('created_at', 'desc')->get();

        $codeBooking = Booking::count();

        if ($transaction->isEmpty()) {
            return redirect('/jobolos/transactions')->with('error', 'you do not have a booking history');
        }

        return view('frontend.history-booking', compact('transaction', 'codeBooking'));
    }

    // method untuk edit update tanggal photoshoot booking
    public function editDate(UpdateDateRequest $request, $id)
    {

        $tanggal = Booking::findOrFail($id);
        $tanggal->update(['tanggal' => $request->tanggal]);


        Alert::success('Berhasil!', 'Tanggal Acara Anda telah di perbarui');
        return redirect('/jobolos/transactions');
    }

    // method untuk cancel photoshoot booking
    public function cancelBooking($id)
    {
        $booking = Booking::findOrFail($id);

        $booking->update([
            'status_pembayaran' => 'cancelled',
        ]);

        Alert::success('Success!', 'Your Booking has been Canceled.');

        return redirect('/jobolos/transactions');
    }

    // MENAMPILKAN DATA TRANSAKSI RENTAL CAMERA TRANSACTION
    public function index_rental()
    {
        $transaction = Rental::with(['cameras', 'lenses', 'rentalPayments'])
            ->where('user_id', auth()->id())
            ->where(function ($query) {
                $query->where('status', 'pending')
                    ->orWhere('status', 'active')
                    ->orWhere('status', 'waiting')
                    ->orWhereHas('rentalPayments', function ($subQuery) {
                        $subQuery->where('status', 'pending')
                            ->orWhere('status', 'rejected');
                    });
            })
            ->orderBy('created_at', 'desc')->get();


        $hasApprovedPayment = $transaction->pluck('rentalPayments')->flatten()->contains('status', 'approved');

        // bank account
        $bankRentalAccounts = BankAccount::all();

        // dd($transaction);
        $codeBooking = Rental::count();

        return view('frontend.rental-transaction', compact('transaction', 'codeBooking', 'hasApprovedPayment', 'bankRentalAccounts'));
    }

    // UNTUK MENAMPILKAN DAFTAR DATA RIWAYAT TRANSAKSI RENTAL KAMERA
    public function show_rental()
    {
        $transaction = Rental::with(['cameras', 'lenses', 'rentalPayments'])
            ->where('user_id', auth()->id())
            ->where('status', 'completed')
            // ->whereHas('rentalPayments', function ($query) {
            //     $query->where('status_pembayaran', 'approved');
            // })
            ->orderBy('created_at', 'desc')->get();

        $codeBooking = Rental::count();

        if ($transaction->isEmpty()) {
            return redirect('/jobolos/rental-transactions')->with('error', 'you do not have a booking history');
        }

        return view('frontend.history-rental-booking', compact('transaction', 'codeBooking'));
    }

    // method untuk cancel rental booking
    public function cancelRentalBooking($id)
    {
        $booking = Rental::findOrFail($id);

        $booking->update([
            'status' => 'cancelled',
        ]);

        Alert::success('Success!', 'Your Booking has been Canceled.');

        return redirect('/jobolos/rental-transaction');
    }
}
