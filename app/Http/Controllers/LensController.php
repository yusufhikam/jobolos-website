<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLensRequest;
use App\Http\Requests\UpdateLensRequest;
use App\Models\CameraType;
use App\Models\Lens;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class LensController extends Controller
{
    // Manage Lens Data
    public function lenses(Request $request)
    {
        $keyword = $request->keyword;
        $tipeKamera = CameraType::with('brands')->get();
        $lenses = Lens::with(['camera_types', 'camera_types.brands'])
            ->where(function ($query) use ($keyword) {
                $query->where('name', 'LIKE', '%' . $keyword . '%')
                    ->orWhereHas('camera_types', function ($q) use ($keyword) {
                        $q->where('name', 'LIKE', '%' . $keyword . '%');
                    });
            })
            ->orWhereHas('camera_types.brands', function ($q) use ($keyword) {
                $q->where('name', 'LIKE', '%' . $keyword . '%');
            })
            ->paginate(5);


        return view('/admin_panel/adminManageLens', compact('lenses', 'tipeKamera'));
    }

    // method untuk tambah data lensa
    public function store_lens(CreateLensRequest $request)
    {
        Lens::create($request->all());

        Alert::success('Berhasil !', 'Data Tipe Lensa telah di Tambahkan');
        return redirect('/admin_panel/adminManageLens');
    }
    // method untuk update data lensa

    public function update_lens(UpdateLensRequest $request, $id)
    {

        $lens = Lens::findOrFail($id);

        $lens->update($request->all());

        Alert::success('Berhasil !', ' Data Tipe Lensa telah di Update');
        return redirect('/admin_panel/adminManageLens');
    }

    // method untuk hapus data lensa
    public function destroy_lens($id)
    {

        $lens = Lens::findOrFail($id);

        $lens->delete();

        Alert::success('Berhasil!', 'Data Tipe Lensa Telah di Hapus');
        return redirect('/admin_panel/adminManageLens');
    }
}