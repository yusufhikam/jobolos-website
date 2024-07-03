<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBookingRequest;
use App\Mail\BookingShipped;
use App\Models\Booking;
use App\Models\Package;
use App\Models\User;
use App\Notifications\BookingNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class BookingController extends Controller
{
    public function booking()
    {

        $bookings = Booking::select('tanggal')->get();
        $bookedDates = $bookings->pluck('tanggal')->toArray();
        // $package = Booking::with('packages')->get();


        return view('frontend.photoshoot-booking', compact('bookedDates'));
    }


    public function createBooking(CreateBookingRequest $request)
    {

        $package_id = $request->package_id;
        $payment_type = $request->payment_type;
        Log::info("Payment Scheme from Form: $payment_type");
        $locationType = $request->location_type;

        // mengambil data user and package details
        $user = auth()->user();
        $package = Package::find($package_id);

        $bookingData = [
            'user_id' => auth()->id(),
            'package_id' => $package_id,
            'tanggal' => $request->tanggal,
            'location_type' => $locationType,
            'location' => $request->location,
            'concept' => $request->concept,
            'payment_type' => $payment_type,
            'payment_status' => 'pending',
            'total_harga' => $this->hitungTotalHarga($package_id, $payment_type, $locationType),
        ];

        $booking = Booking::create($bookingData);

        $admins = User::whereHas('nama_role', function ($query) {
            $query->where('name', 'admin');
        })->get();

        // Kirim notifikasi email ke admin
        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(new BookingShipped($bookingData, $user, $package));
        }
        // $adminEmail = 'yoeshika.project@gmail.com'; // Ganti dengan email admin Anda

        Alert::success('Successfull !', 'You have booked a photo session. You will be redirected to the transaction page');

        return redirect('/jobolos/transactions');
    }

    public function hitungTotalHarga($package_id, $payment_type, $locationType)
    {
        $package = Package::findOrFail($package_id);
        $hargaPackage = $package->harga;
        $biayaTambahan = 250000; // biaya tambahan 500000


        // Jika location_type 'other', tambahkan biaya tambahan
        if ($payment_type === 'dp') {
            // DP adalah 10% dari harga package
            $harga = $hargaPackage * 0.1;

            if ($locationType === 'other') {
                $harga += $biayaTambahan;
            }
        } else if ($payment_type === 'full') {

            // jika location type = other
            if ($locationType === 'other') {
                $harga = $hargaPackage + $biayaTambahan;
            } else {
                // Lunas adalah 100% dari harga package
                $harga = $hargaPackage;
            }
        }

        return $harga;
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
