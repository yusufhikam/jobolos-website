<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCameraTypeRequest;
use App\Models\Brand;
use App\Models\CameraType;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CameraTypeController extends Controller
{

    // method untuk menampilkan data camera types
    public function camera_types()
    {
        $brands = Brand::select('id', 'name')->get();

        $camera_types = CameraType::with('brands')->paginate(5);

        return view('/admin_panel/adminManageCameraType', compact('camera_types', 'brands'));
    }

    // method untuk tambah data camera types
    public function store_camera_types(CreateCameraTypeRequest $request)
    {

        CameraType::create($request->all());

        Alert::success('Berhasil!', 'Data Tipe Kamera telah ditambahkan');
        return redirect('/admin_panel/adminManageCameraType');
    }

    // method untuk update data camera types
    public function update_camera_types(Request $request, $id)
    {
        // Validasi input form
        $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'name' => 'required|string|max:255',
        ]);


        $camera_types = CameraType::findOrFail($id);

        $camera_types->update([
            'brand_id' => $request->brand_id,
            'name' => $request->name,
            // tambahkan field lain yang perlu diupdate
        ]);
        return redirect('/admin_panel/adminManageCameraType');
    }

    // method untuk hapus data camera type
    public function destroy_camera_types($id)
    {

        $camera_types = CameraType::findOrFail($id);

        if ($camera_types->lenses()->count() > 0) {

            Alert::error('Oops!', 'Tipe Kamera ' . $camera_types->name . ' ini tidak dapat dihapus, karena telah terekam pada data Camera');
            return redirect('/admin_panel/adminManageCameraType');
        } else {
            $camera_types->delete();

            Alert::success('Berhasil !', 'Data Tipe Kamera telah di Hapus');
            return redirect('/admin_panel/adminManageCameraType');
        }
    }
}