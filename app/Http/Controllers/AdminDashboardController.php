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

        $pendapatanPhotoshoot = Booking::count('total_harga');
        $pendpaatanRental = Rental::count('total_harga');


        return view('/admin_panel/adminDashboard', compact('newBooking', 'userRegistered', 'paymentConfirm', 'paymentRentalConfirm', 'newRentalBooking', 'pendpatanPhotoshoot', 'pendapatanRental'));
    }

    // METHOD UNTUK MENANDAI CALENDAR JIKA ADA PHOTOSHOOT BOOKING
    public function getBookings()
    {
        $today = date('Y-m-d');
        $bookings = Booking::where('tanggal', '>=', $today)->select('tanggal')->get();

        $events = $bookings->map(function ($booking) {
            return [
                'title' => 'BOOKED',
                'start' => $booking->tanggal,
                // 'end' => $booking->tanggal,
                'allDay' => true,
            ];
        });

        return response()->json($events);
    }
}
