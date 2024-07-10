<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingConfirmationController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BookingReceivedController;
use App\Http\Controllers\BookingRentalCameraController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\BusinessPlanController;
use App\Http\Controllers\CameraController;
use App\Http\Controllers\CameraTypeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\LensController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentRentalCameraController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RekapBulananController;
use App\Http\Controllers\RentalBookingConfirmationController;
use App\Http\Controllers\RentalBookingReceived;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Models\Booking;
use App\Models\Camera;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/





// LOGIN ROUTE
Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate'])->middleware('guest');

// LOG OUT
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');

// REGISTER ROUTE
Route::get('/register', [RegisterController::class, 'index'])->name('register')->middleware('guest');
Route::post('/register', [RegisterController::class, 'register'])->middleware('guest');
// routing group for middleware

// ADMIN PANEL ROUTE
Route::middleware(['auth', 'role:admin'])->group(function () {


    Route::get('/admin_panel/adminDashboard', [AdminDashboardController::class, 'index'])->name('admin_panel.adminDashboard');
    Route::get('/admin_panel/getBookings', [AdminDashboardController::class, 'getBookings']);
    Route::get('/admin_panel/adminManageUser', [UserController::class, 'index'])->name('admin_panel.adminManageUser'); // method index umumnya dilaravel digunakan untuk menampilkan seluruh data
    Route::get('/admin_panel/admin-add-user', [UserController::class, 'create'])->name('admin_panel.admin-add-user');  // method create umumnya dilaravel digunakan untuk menambah data / insert
    Route::post('/admin_panel/adminManageUser', [UserController::class, 'store']); // method store umumnya di laravel digunakan untuk proses pengiriman / request penambahan data / insert
    // admin delete user
    Route::get('/admin_panel/admin-delete-user/{id}', [UserController::class, 'delete']);
    Route::delete('/admin_panel/admin-destroy-user/{id}', [UserController::class, 'destroy']);

    // admin edit-update user
    Route::get('/admin_panel/admin-edit-user/{id}', [UserController::class, 'edit'])->name('admin_panel.admin-add-user');
    Route::put('/admin_panel/adminManageUser/{id}', [UserController::class, 'update']);

    // admin manage category, add category, edit-update category, and delete category
    Route::get('/admin_panel/adminManageCategory', [CategoryController::class, 'index'])->name('admin_panel.adminManageCategory');
    Route::get('/admin_panel/admin-add-category', [CategoryController::class, 'create'])->name('admin_panel.adminManageCategory');
    Route::post('/admin_panel/adminManageCategory', [CategoryController::class, 'store']);
    Route::get('/admin_panel/admin-delete-category/{id}', [CategoryController::class, 'delete']);
    Route::delete('/admin_panel/admin-destroy-category/{id}', [CategoryController::class, 'destroy']);
    Route::get('/admin_panel/admin-edit-category/{id}', [CategoryController::class, 'edit']);
    Route::put('/admin_panel/adminManageCategory/{id}', [CategoryController::class, 'update']);

    // admin manage gallery, add gallery/album, edit-update gallery, delete gallery
    Route::get('/admin_panel/adminManageGallery', [AlbumController::class, 'index'])->name('admin_panel.adminManageGallery');
    Route::get('/admin_panel/admin-add-album', [AlbumController::class, 'create'])->name('admin_panel.adminManageGallery');
    Route::post('/admin_panel/adminManageGallery', [AlbumController::class, 'store']);
    Route::delete('/admin_panel/admin-destroy-album/{id}/{title}', [AlbumController::class, 'destroy']);
    Route::get('/admin_panel/admin-add-photo', [PhotoController::class, 'index'])->name('admin_panel.adminManageGallery');
    Route::post('/admin_panel/adminManageGallery', [PhotoController::class, 'store']);
    // menampilkan foto ke manage gallery folder album
    Route::get('/admin_panel/albums/{id}/{title}', [AlbumController::class, 'show'])->name('admin_panel.adminManageGallery');


    // manage package
    Route::get('/admin_panel/adminManagePackage', [PackageController::class, 'index'])->name('admin_panel.adminManagePackage');
    // add package page
    Route::get('/admin_panel/admin-add-package', [PackageController::class, function () {
        return view('/admin_panel/admin-add-package');
    }])->name('admin_panel.adminManagePackage');
    Route::post('/admin_panel/adminManagePackage', [PackageController::class, 'store']);
    Route::get('/admin_panel/admin-edit-package/{id}', [PackageController::class, 'edit'])->name('admin_panel.adminManagePackage');
    Route::put('/admin_panel/adminManagePackage/{id}', [PackageController::class, 'update']);
    Route::delete('/admin_panel/admin-destroy-package/{id}', [PackageController::class, 'destroy']);

    // booking confirmation
    Route::get('/admin_panel/adminManageBookingReceived', [BookingReceivedController::class, 'index'])->name('admin_panel.adminManageBookingReceived');
    Route::get('/admin_panel/adminManageBookingConfirmation', [BookingConfirmationController::class, 'index'])->name('admin_panel.adminManageBookingConfirmation');
    Route::put('/admin_panel/adminManageBookingConfirmation/approve/{id}', [BookingConfirmationController::class, 'approve'])->name('admin_panel.adminManageBookingConfirmation.approve');
    Route::put('/admin_panel/adminManageBookingConfirmation/rejected/{id}', [BookingConfirmationController::class, 'rejected'])->name('admin_panel.adminManageBookingConfirmation.rejected');
    Route::get('/mail/invoiceBooking', function () {
        return view('/mail/invoiceBooking');
    });
    // detail confirmed payment booking
    Route::get('/admin_panel/adminManageBookingConfirmation/Detail-Booking-Confirmed/{id}/{name}', [BookingConfirmationController::class, 'detail_confirmed'])->name('admin_panel.adminManageBookingConfirmation.detail');
    // download PDF detail confirmed payment booking
    Route::get('/admin_panel/download-pdf/{id}', [BookingConfirmationController::class, 'downloadPDF'])->name('admin_panel.downloadPDF');
    // untuk rekap data bulanan photoshoot
    Route::get('/admin_panel/Rekap-Photoshoot', [RekapBulananController::class, 'show'])->name('admin_panel.adminPhotoshootRekap');



    // ADMIN RENTAL CAMERA
    // MANAGE CAMERA

    // untuk menampilkan data kamera
    Route::get('/admin_panel/adminManageCamera', [CameraController::class, 'index'])->name('admin_panel.adminManageCamera');
    // untuk menambahkan data kamera
    Route::post('/admin_panel/adminManageCamera', [CameraController::class, 'store_cameras']);
    // untuk menghapus data kamera
    Route::delete('/admin_panel/adminManageCamera/destroy-camera{id}', [CameraController::class, 'destroy_cameras'])->name('admin_panel.adminManageCamera.delete');
    // untuk edit data kamera
    Route::put('/admin_panel/adminManageCamera/Edit-Camera-{id}', [CameraController::class, 'update_cameras']);
    // untuk menampilkan data tipe kamera
    Route::get('/admin_panel/adminManageCameraType', [CameraTypeController::class, 'camera_types'])->name('admin_panel.adminManageCamera.CameraType');
    // untuk menambahkan data camera types
    Route::post('/admin_panel/adminManageCameraType/Add-Camera-Types', [CameraTypeController::class, 'store_camera_types']);
    // untuk hapus data camera types
    Route::delete('/admin_panel/adminManageCameraType/destroy-camera-type{id}', [CameraTypeController::class, 'destroy_camera_types']);
    // untuk mengedit data camera types
    Route::put('/admin_panel/adminManageCameraType/Edit-Camera-Type/{id}', [CameraTypeController::class, 'update_camera_types']);
    // untuk menampilkan data brands
    Route::get('/admin_panel/adminManageBrands', [BrandController::class, 'brands'])->name('admin_panel.adminManageBrands');
    // untuk menambah data brands
    Route::post('/admin_panel/adminManageBrands', [BrandController::class, 'store_brands'])->name('admin_panel.adminManageBrands');
    // untuk menghapus data brands
    Route::delete('/admin_panel/adminManageBrands/{id}', [BrandController::class, 'destroy_brands'])->name('admin_panel.adminManageBrands');
    // untuk edit data brands
    Route::put('/admin_panel/adminManageBrands/{id}', [BrandController::class, 'update_brands'])->name('admin_panel.adminManageBrands');
    // untuk menampilkan data lens
    Route::get('/admin_panel/adminManageLens', [LensController::class, 'lenses'])->name('admin_panel.adminManageLens');
    // untuk menambahkan data lens
    Route::post('/admin_panel/adminManageLens', [LensController::class, 'store_lens'])->name('admin_panel.adminManageLens');
    // untuk update data lens
    Route::put('/admin_panel/adminManageLens/{id}', [LensController::class, 'update_lens'])->name('admin_panel.adminManageLens');
    // untuk hapus data lens
    Route::delete('/admin_panel/adminManageLens/{id}', [LensController::class, 'destroy_lens'])->name('admin_panel.adminManageLens');

    // RENTAL CAMERA BOOKING RECEIVED
    Route::get('/admin_panel/adminManageBookingReceivedRental', [RentalBookingReceived::class, 'index'])->name('admin_panel.adminManageBookingReceivedRental');

    // RENTAL CAMERA BOOKING CONFIRMATION
    Route::get('/admin_panel/adminManageBookingConfirmationRental', [RentalBookingConfirmationController::class, 'index'])->name('admin_panel.adminManageBookingConfirmationRental');
    // untuk konfirmasi bukti pembayaran menjadi status_pembayaran 'approved'
    Route::put('/admin_panel/adminManageBookingConfirmationRental/approve/{id}', [RentalBookingConfirmationController::class, 'approve'])->name('admin_panel.adminManageBookingConfirmationRental.approve');
    // untuk konfirmasi bukti pembayaran menjadi status_pembayaran 'rejected'
    Route::put('/admin_panel/adminManageBookingConfirmationRental/rejected/{id}', [RentalBookingConfirmationController::class, 'rejected'])->name('admin_panel.adminManageBookingConfirmationRental.rejected');
    // untuk konfirmasi penyewaan telah selesai status pada rentals menjadi 'completed'
    Route::put('/admin_panel/adminManageBookingConfirmationRental/completed/{id}', [RentalBookingConfirmationController::class, 'completed'])->name('admin_panel.adminManageBookingConfirmationRental.completed');
    // load view untuk invoice mail
    Route::get('/mail/invoiceBooking', function () {
        return view('/mail/invoiceBooking');
    });
    // detail confirmed payment booking
    Route::get('/admin_panel/adminManageBookingConfirmation/Detail-Booking-Confirmed/{id}/{name}', [BookingConfirmationController::class, 'detail_confirmed'])->name('admin_panel.adminManageBookingConfirmation.detail');
    // download PDF detail confirmed payment booking
    Route::get('/admin_panel/download-pdf/{id}', [BookingConfirmationController::class, 'downloadPDF'])->name('admin_panel.downloadPDF');
    // untuk rekap data bulanan photoshoot
    Route::get('/admin_panel/Rekap-Rental', [RekapBulananController::class, 'show_rental'])->name('admin_panel.adminRentalRekap');

    // ADMIN MANAGE KONTENT
    Route::get('/admin_panel/adminManageContents', [BusinessPlanController::class, 'index'])->name('admin_panel.adminManageContents');
    // untuk menampilkan data halaman About us
    // Route::get('/admin_panel/adminManageContents', [BusinessPlanController::class, 'about_us'])->name('admin_panel.adminManageContents');
    // untuk menambahkan data crew
    Route::post('/admin_panel/adminManageContents', [BusinessPlanController::class, 'store_aboutUs']);
    // untuk menghapus data crew
    Route::delete('/admin_panel/adminManageContents/{id}', [BusinessPlanController::class, 'destroy_crew'])->name('admin_panel.adminManageContents');
    Route::put('/admin_panel/adminManageContents/edit-{id}', [BusinessPlanController::class, 'update_crew'])->name('admin_panel.adminManageContents');

    // untuk tambah data bank untuk transfer
    Route::post('/admin_panel/adminManageContents/store_akunBank', [BusinessPlanController::class, 'store_akunBank'])->name('admin_panel.adminManageContents.Bank');
    // untuk edit data bank untuk transfer
    Route::put('/admin_panel/adminManageContents/edit/bank/{id}', [BusinessPlanController::class, 'update_akunBank'])->name('admin_panel.adminManageContents.updateBank');
    // untuk delete data bank
    Route::delete('/admin_panel/adminManageContents/delete/bank-{id}', [BusinessPlanController::class, 'destroy_akunBank']);

    // NOTIFICATION REDIRECT
    Route::get('/admin_panel/notification/{id}/redirect', [NotificationController::class, 'redirect']);
});



// FRONT END / CUSTOMER PANEL ROUTE

// halaman yang bisa diakses user tanpa harus login
Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();
        if ($user && $user->nama_role) {
            if ($user->nama_role->name === 'admin') {
                return redirect()->route('admin_panel.adminDashboard');
            }
        }
    }
    return app(FrontendController::class)->home();
});

// untuk menuju & menampilkan halaman stories
Route::get('/jobolos/stories', [FrontendController::class, 'stories'])->name('frontend.stories');
// untuk menampilkan data seluruh album
Route::get('/jobolos/album/{id}/{title}', [FrontendController::class, 'show'])->name('frontend.album');
// untuk menampilkan data detail album
Route::get('/jobolos/gallery-{id}/{name}', [FrontendController::class, 'show_gallery'])->name('frontend.show_gallery');
// untuk menampilkan halaman about
Route::get('/jobolos/about', [FrontendController::class, 'about'])->name('frontend.about');
// untuk menampilkan halaman packages photoshoot & rental camera
Route::get('/jobolos/package-info', function () {
    return view('frontend.package');
})->name('frontend.package');
// untuk menampilkan data packages photoshoot
Route::get('/jobolos/package-info/photoshoot-packages', [FrontendController::class, 'photoshoot_packages'])->name('frontend.photoshoot-packages');
// untuk menampilkan detail data packages photoshoot
Route::get('/jobolos/package-info/photoshoot-detail-{id}/{name}', [FrontendController::class, 'photoshoot_pcg_detail'])->name('frontend.photoshoot-pcg-detail');
// untuk menampilkan data package rental camera
Route::get('/jobolos/package-info/camera-info', [FrontendController::class, 'camera_info'])->name('frontend.camera-info');
// untuk menampilkan data detail package rental camera
Route::get('/jobolos/camera-detail-{id}/{name}', [FrontendController::class, 'camera_detail']);
// untuk menampilkan halaman contact (booking form)
Route::get('/jobolos/contact', function () {
    return view('/frontend/contact');
})->name('frontend.contact');

// Photoshoot Booking Form
Route::get('/jobolos/contact/photoshoot-booking', [BookingController::class, 'booking'])->name('frontend.photoshoot-booking');
// untuk menampilkan data yang sudah booking di calendar
Route::get('/jobolos/photoshoot-info/getBookings', [BookingController::class, 'getBookings']);
// untuk update data calendar berdasarkan status

// RENTAL CAMERA BOOKING FORM
Route::get('/jobolos/rental-camera-booking/{id}/{name}', [BookingRentalCameraController::class, 'booking'])->name('frontend.transaction_rental');




// halaman yang hanya bisa diakses user yang sudah login dan memiliki role 'customer'
Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::post('/jobolos/contact/photoshoot-booking', [BookingController::class, 'createBooking'])->name('frontend.photoshoot-booking');

    // PHOTOSHOOT BOOKING MANAGE
    Route::get('/frontend/dashboard', [FrontendController::class, 'home'])->name('frontend.dashboard');
    Route::get('/jobolos/transactions', [TransactionController::class, 'index'])->name('frontend.transactions');
    // untuk upload bukti pembayaran photoshoot booking
    Route::post('/jobolos/transactions/payment/{id}', [PaymentController::class, 'uploadBukti'])->name('frontend.transactions.payment');
    // untuk update bukti pembayaran photoshoot booking jika tidak valid
    Route::put('/jobolos/transactions/payment/{id}', [PaymentController::class, 'updateBukti'])->name('frontend.transactions.payment');
    // untuk update tanggal acara
    Route::put('/jobolos/transactions/updateDate/{id}', [TransactionController::class, 'editDate'])->name('frontend.transactions.updateDate');
    // untuk cancel booking
    Route::put('/jobolos/transactions/cancel/{id}', [TransactionController::class, 'cancelBooking'])->name('frontend.transaction.cancel');
    // untuk menampilkan daftar history pemesanan
    Route::get('/jobolos/transactions/history-booking', [TransactionController::class, 'show']);

    // RENTAL CAMERA BOOKING MANAGE

    // untuk menampilkan daftar transaksi
    Route::get('/jobolos/rental-transactions', [TransactionController::class, 'index_rental'])->name('frontend.rental-transactions');
    // untuk melakukan pemesanan booking rental kamera
    Route::post('/jobolos/rental-camera-booking', [BookingRentalCameraController::class, 'store_booking'])->name('frontend.rental-booking');
    // untuk menampilkan history booking rental kamera
    Route::get('/jobolos/transactions/history-rental-booking', [TransactionController::class, 'show_rental']);
    // untuk upload bukti pembayaran
    Route::post('/jobolos/rental-transactions/payment/{id}', [PaymentRentalCameraController::class, 'uploadBukti'])->name('frontend.rental-transactions.payment');
    Route::put('/jobolos/rental-transactions/cancel/{id}', [TransactionController::class, 'cancelRentalBooking']);
});
