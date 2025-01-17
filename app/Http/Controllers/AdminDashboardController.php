<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\Rental;
use App\Models\RentalPayment;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $newBooking = Booking::where('status_pembayaran', 'pending')->count();
        $userRegistered = User::count();
        $paymentConfirm = Payment::where('status', 'pending')->count();
        $paymentRentalConfirm = RentalPayment::where('status_pembayaran', 'pending')->count();
        $newRentalBooking = Rental::where('status', 'pending')->count();

        // untuk menampilkan pendapatan perbulan
        $pendapatanPhotoshoot = Booking::whereHas('payments', function ($query) {
            $query->where('status', 'approved');
        })->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->sum('total_harga');
        $pendapatanRental = Rental::whereHas('rentalPayments', function ($query) {
            $query->where('status_pembayaran', 'approved');
        })->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->sum('total_harga');


        return view('/admin_panel/adminDashboard', compact('newBooking', 'userRegistered', 'paymentConfirm', 'paymentRentalConfirm', 'newRentalBooking', 'pendapatanPhotoshoot', 'pendapatanRental'));
    }

    // METHOD UNTUK MENANDAI CALENDAR JIKA ADA PHOTOSHOOT BOOKING
    public function getBookings()
    {
        $today = date('Y-m-d');
        $bookings = Booking::where('tanggal', '>=', $today)
            ->whereIn('status_pembayaran', ['pending', 'completed'])
            ->select('tanggal')
            ->get();

        $events = $bookings->map(function ($booking) {
            return [
                'title' => $booking->status == 'completed' ? 'COMPLETED' : 'BOOKED',                'start' => $booking->tanggal,
                // 'end' => $booking->tanggal,
                'allDay' => true,
            ];
        });

        return response()->json($events);
    }
}
