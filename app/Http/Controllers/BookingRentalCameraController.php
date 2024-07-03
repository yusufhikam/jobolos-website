<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRentalBookingRequest;
use App\Mail\RentalCameraBookingShipped;
use App\Models\Camera;
use App\Models\Lens;
use Carbon\Carbon;

use App\Models\Rental;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class BookingRentalCameraController extends Controller
{
    // public function index(){

    // }


    public function booking(Request $request, $id, $name)
    {

        // Carbon::setLocale('id'); // Mengatur lokal Carbon ke bahasa Indonesia


        $cameras = Camera::with(['camera_types.brands', 'camera_types.lenses', 'rentals' => function ($query) {
            $query->where('status', 'active');
        }])->findOrFail($id);

        $cameraRented = $cameras->rentals->isNotEmpty();

        // $rentals = Rental::with(['users', 'cameras.camera_types', 'camera_types.brands', 'lenses']);
        return view('frontend.rental-camera-booking', compact('cameras', 'cameraRented'));
    }

    // method untuk membuat pesanan booking rental kamera
    public function store_booking(CreateRentalBookingRequest $request)
    {

        $tglSewa = $request->tgl_sewa;
        $tglKembali = $request->tgl_kembali;
        $cameraId = $request->camera_id;
        $lensId = $request->lens_id;

        $camera = Camera::findOrFail($cameraId);
        $lens = Lens::findOrFail($lensId);
        $user = auth()->user();

        $bookingData = [
            'user_id' => auth()->id(),
            'camera_id' => $cameraId,
            'lens_id' => $lensId,
            'tgl_sewa' => $tglSewa,
            'tgl_kembali' => $tglKembali,
            'jaminan' => 'KTP',
            'status' => 'pending',
            'total_harga' => $this->hitungTotalHarga($cameraId, $lensId, $tglSewa, $tglKembali),
        ];

        $rental = Rental::create($bookingData);


        $admins = User::whereHas('nama_role', function ($query) {
            $query->where('name', 'admin');
        })->get();

        // Kirim notifikasi ke email admin
        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(new RentalCameraBookingShipped($bookingData, $user, $camera, $lens));
        }

        // kirim notifikasi ke email Admin
        Alert::success('Successfull !', 'You have booked a rent camera. You will be redirected to the transaction page');
        return redirect('/jobolos/rental-transactions');
    }

    // method untuk hitung total harga rental
    public function hitungTotalHarga($cameraId, $lensId, $tglSewa, $tglKembali)
    {
        $camera = Camera::findOrFail($cameraId);
        $lens = Lens::findOrFail($lensId);

        // menghitung durasi sewa 
        $durasiSewa = (new \DateTime($tglKembali))->diff(new \DateTime($tglSewa))->days;

        // jika durasi sewa kurang dari 1 hari, maka dianggap tetap 1 hari
        if ($durasiSewa < 1) {
            $durasiSewa = 1;
        }
        return ($camera->harga_per_hari + $lens->harga_per_hari) * $durasiSewa;
    }
}