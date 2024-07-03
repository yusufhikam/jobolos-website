<?php

namespace App\Providers;

use App\Models\Booking;
use App\Models\Category;
use App\Models\Package;
use App\Models\Payment;
use App\Models\Rental;
use App\Models\RentalPayment;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Menggunakan View Composer untuk mengikat data ke semua view
        View::composer('*', function ($view) {
            // Mengambil semua data dari model Package dan Category
            $packages = Package::all();
            $categories = Category::all();

            // PHOTOSHOOT BOOKING
            // menghitung jumlah booking yang masuk pada side bar booking received
            $bookingReceived = Booking::where('status_pembayaran', 'pending')->count();
            // menghitung jumlah payment confirm yang masuk pada side bar booking confirmation
            $paymentConfirm = Payment::where('status', 'pending')->count();

            // CAMERA RENTAL BOOKING
            // untuk mengambil jumlah rental yanng statusnya pending (belum dibayar)
            $cameraBookingReceived = Rental::where('status', 'pending')->orWhere('status', 'waiting')->count();
            // untuk mengambil jumlah rentalPayments yang belum dikonfirmasi
            $cameraPaymentConfirm = RentalPayment::where('status_pembayaran', 'pending')->count();

            // Mengikat data 'packages' dan 'categories' ke semua view
            $view->with('packages', $packages)
                ->with('categories', $categories)
                ->with('bookingReceived', $bookingReceived)
                ->with('paymentConfirm', $paymentConfirm)
                ->with('cameraBookingReceived', $cameraBookingReceived)
                ->with('cameraPaymentConfirm', $cameraPaymentConfirm);
        });

        // View::composer('/layouts/admin_panel/sidebarLayout', function ($view) {
        //     $bookingReceived = Booking::where('status', 'pending')->count();
        //     $view->with('bookingReceived', $bookingReceived);
        // });
    }
}