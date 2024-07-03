<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePackageRequest;
use App\Http\Requests\UpdatePackageRequest;
use App\Models\Package;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PackageController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $package = Package::where('name', 'LIKE', '%' . $keyword . '%')
            ->orWhere('harga', 'LIKE', '%' . $keyword . '%')
            ->paginate(5);


        return view('/admin_panel/adminManagePackage', compact('package'));
    }

    public function store(CreatePackageRequest $request)
    {
        // upload foto
        $newName = ''; // nama default kosong jika tidak mengupload foto

        if ($request->file('foto')) {

            $extension = $request->file('foto')->getClientOriginalExtension();
            $newName = $request->name . '-' . now()->timestamp . '.' . $extension;

            $request->file('foto')->storeAs('/admin_assets/package', $newName, 'public');
        }

        // Tambahkan nama file foto ke request
        $request['image'] = $newName;

        $package = Package::create($request->except('foto'));

        Alert::success('Berhasil!', 'Paket Photoshoot ' . $request->name . ' telah ditambahkan!');

        return redirect('/admin_panel/adminManagePackage');
    }

    public function edit($id)
    {
        $package = Package::findOrFail($id);

        return view('/admin_panel/admin-edit-package', compact('package'));
    }

    public function update(UpdatePackageRequest $request, $id)
    {

        $package = Package::findOrFail($id);
        // upload foto
        $newName = ''; // nama default kosong jika tidak mengupload foto

        if ($request->file('foto')) {

            $extension = $request->file('foto')->getClientOriginalExtension();
            $newName = $request->name . '-' . now()->timestamp . '.' . $extension;

            $request->file('foto')->storeAs('/admin_assets/package', $newName, 'public');
            $request['image'] = $newName;
        } else {
            // Tambahkan nama file foto ke request
            $request['image'] = $package->image; // pertahankan nama file lama jika tidak ada file baru yang di upload
        }

        $package->update($request->except('foto'));

        Alert::success('Berhasil!', 'Paket Photoshoot ' . $request->name . ' telah di Update!');

        return redirect('/admin_panel/adminManagePackage');
    }

    public function destroy($id)
    {

        $package = Package::findOrFail($id);

        if ($package->bookings->count() > 0) {
            Alert::error('Oops!', 'Anda tidak dapat menghapus ' . $package->name . ' karena data ini telah terekam pada Booking');

            return redirect('/admin_panel/adminManagePackage');
        } else {

            $package->delete($id);

            Alert::success('Berhasil!', 'Paket Photoshoot ' . $package->name . ' telah di Hapus!');

            return redirect('/admin_panel/adminManagePackage');
        }
    }
}