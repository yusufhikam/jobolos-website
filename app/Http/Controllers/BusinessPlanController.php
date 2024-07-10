<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use App\Models\Crew;
use App\Models\Page;
use App\Models\SubContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class BusinessPlanController extends Controller
{
    public function index()
    {
        // untuk data crew (page about us)
        $crews = Crew::paginate(5);

        // untuk data page transaction
        $akunBank = BankAccount::paginate(4);

        return view('/admin_panel/adminManageContents', compact('crews', 'akunBank'));
    }

    // METHOD UNTUK MENAMBAHKAN DATA CREW
    public function store_aboutUs(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // adjust the max size as per your needs
            'deskripsi' => 'nullable|string',
            // Add other validation rules as per your requirements
        ]);

        // foto
        $newName = '';

        if ($request->file('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->name . '-' . now()->timestamp . '.' . $extension;

            $request->file('image')->storeAs('/admin_assets/dataCrew', $newName, 'public');
        }

        // menambahkan nama file ke request
        $data = $request->all();
        $data['image'] = $newName;

        // Creating the crew record
        $crew = Crew::create($data);

        Alert::success('Berhasil !', 'Data Crew Telah di Simpan');

        return redirect('/admin_panel/adminManageContents');
    }

    // METHOD UNTUK MENGUPDATE DATA CREW DAN MENGUPDATE IMAGE KEMUDIAN MENGHAPUS IMAGE LAMA
    public function update_crew(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // adjust the max size as per your needs
            'deskripsi' => 'nullable|string',
            // Add other validation rules as per your requirements
        ]);

        $crew = Crew::findOrFail($id);

        // untuk default nama file image jika tidak upload ulang
        $newName = $crew->image;

        if ($request->hasFile('image')) {
            // menghapus file image lama
            if ($crew->image && Storage::disk('public')->exists('admin_assets/dataCrew/' . $crew->image)) {
                Storage::disk('public')->delete('admin_assets/dataCrew/' . $crew->image);
            }

            // upoload image baru

            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->name . '-' . now()->timestamp . '.' . $extension;
            $request->file('image')->storeAs('/admin_assets/dataCrew', $newName, 'public');
        }

        $data = $request->all();
        $data['image'] = $newName;

        // Updating data crew
        $crew->update($data);

        Alert::success('Berhasil !', 'Data crew telah di Update');

        return redirect('admin_panel/adminManageContents');
    }

    // METHOD UNTUK MENGHAPUS DATA CREW DAN MENGHAPUS FILE FOTO YANG BERADA DI DIRECTORY
    public function destroy_crew($id)
    {

        $crew = Crew::findOrFail($id);

        // menghapus data file foto
        if ($crew->image && Storage::disk('public')->exists('admin_assets/dataCrew/' . $crew->image)) {
            Storage::disk('public')->delete('admin_assets/dataCrew/' . $crew->image);
        }

        $crew->delete();

        Alert::success('Berhasil !', 'Data Crew Telah di Hapus');

        return redirect('/admin_panel/adminManageContents');
    }

    // METHOD UNTUK MENAMBAHKAN DATA BANK
    public function store_akunBank(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'bank_name' => 'required|max:255', // adjust the max size as per your needs
            'no_rek' => 'required|max:20',
            // Add other validation rules as per your requirements
        ]);

        $akunBank = BankAccount::create($request->all());

        Alert::success('Berhasil !', 'Data Akun Bank telah ditambahkan');

        return redirect('/admin_panel/adminManageContents');
    }

    // METHOD UNTUK EDIT DATA BANK
    public function update_akunBank(Request $request, $id)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'bank_name' => 'required|max:255', // adjust the max size as per your needs
            'no_rek' => 'required|integer|max:20',
            // Add other validation rules as per your requirements
        ]);

        $akunBank = BankAccount::findOrFail($id);
        $akunBank->update($request->all());

        Alert::success('Berhasil !', 'Data Akun Bank telah diupdate');

        return redirect('/admin_panel/adminManageContents');
    }



    // METHOD UNTUK DELETE DATA AKUN BANK
    public function destroy_akunBank($id)
    {
        $akunBank = BankAccount::findOrFail($id);
        $akunBank->delete();
        Alert::success('Berhasil !', 'Data Akun Bank telah dihapus');
        return redirect('/admin_panel/adminManageContents');
    }
}
