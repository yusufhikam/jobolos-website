<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index(Request $request)
    {

        $keyword = $request->keyword;
        $user = User::with('nama_role')
            ->where('name', 'LIKE', '%' . $keyword . '%')
            ->orWhere('email', 'LIKE', '%' . $keyword . '%')
            ->orWhereHas('nama_role', function ($query) use ($keyword) {
                $query->where('name', 'LIKE', '%' . $keyword . '%');
            })
            ->orWhere('alamat', 'LIKE', '%' . $keyword . '%')
            ->orWhere('no_telp', 'LIKE', '%' . $keyword . '%')
            ->paginate(5);


        // sweet alert Confirm Delete
        $title = 'Hapus User!';
        $text = "Apakah Anda yakin ingin menghapus Data User?";
        confirmDelete($title, $text);

        // dd($user);
        return view('/admin_panel/adminManageUser', compact('user'));
    }

    // method untuk menampilkan detail user
    public function show($id)
    {
        $user = User::with('nama_role')->findOrFail($id);

        return view('/admin_panel/adminManageUser', compact('user'));
    }

    public function create()
    {
        $role = Role::select('id', 'name')->get(); // untuk menammpilkan data role untuk form select pilih role yang relasi dengan table role
        return view('/admin_panel/admin-add-user', compact('role'));
    }

    // method untuk INSERT DATA / menambahkan data 

    public function store(UserCreateRequest $request)
    {
        // upload foto
        $newName = ''; // nama default kosong jika tidak mengupload foto

        if ($request->file('foto')) {

            $extension = $request->file('foto')->getClientOriginalExtension();
            $newName = $request->name . '-' . now()->timestamp . '.' . $extension;

            $request->file('foto')->storeAs('/admin_assets/images_users', $newName, 'public');
        }

        // CARA INSERT DATA dengan MASS ASSIGMENT

        // enkripsi password
        $request['password'] = Hash::make($request->password);

        // Tambahkan nama file foto ke request
        $request['image'] = $newName;

        // Buat pengguna baru
        $user = User::create($request->all());

        //  SESSION FLASH MESSAGE DATA / notifikasi ketika data berhasil disimpan
        // if ($user) {
        //     Session::flash('status', 'success');
        //     Session::flash('message', 'Data berhasil di Simpan');
        // } else {
        //     // Simpan pesan kesalahan
        //     Session::flash('status', 'error');
        //     Session::flash('message', 'Data gagal disimpan');
        // }

        Alert::success('Berhasil!', 'Data User Telah Tersimpan!');
        return redirect('/admin_panel/adminManageUser');
    }


    // method untuk mengambil UPDATE Data User

    public function edit($id)
    {
        $user = User::with('nama_role')->findOrFail($id);
        $role = Role::where('id', '!=', $user->role_id)->select('id', 'name')->get();

        return view('/admin_panel/admin-edit-user', compact('user', 'role'));
    }

    // method untuk UPDATE DATA USER
    public function update(UserUpdateRequest $request, $id)
    {
        // mencari user berdasarkan id yang dipilih
        $user = User::findOrFail($id);


        // upload foto
        $newName = ''; // nama default kosong jika tidak mengupload foto

        if ($request->file('foto')) {

            $extension = $request->file('foto')->getClientOriginalExtension();
            $newName = $request->name . '-' . now()->timestamp . '.' . $extension;

            $request->file('foto')->storeAs('/admin_assets/images_users', $newName, 'public');
            $request['image'] = $newName;
        } else {
            // Tambahkan nama file foto ke request
            $request['image'] = $user->image; // pertahankan nama file lama jika tidak ada file baru yang di upload
        }

        // CARA UPDATE DATA dengan MASS ASSIGMENT



        // cek email unique
        $penggunaTerdaftar = User::where('email', $request->email)->first();

        if ($penggunaTerdaftar && $penggunaTerdaftar->id != $user->id) {
            Alert::error('Gagal!', 'Email tersebut sudah ada dan tidak boleh sama');

            return redirect('/admin_panel/admin-edit-user/' . $user->id . '');
        }

        // Update password hanya jika berbeda dengan password yang ada di database
        if ($request->filled('password')) {

            // enkripsi password
            $request['password'] = Hash::make($request->password);
        } else {
            $request['password'] = $user->password; // pertahankan password lama jika tidak diubah
        }

        // Update pengguna 
        $user->update($request->except('password')); // jagan masukkan password jika tidak ada perubahan

        // jika password diisi, update secara manual
        if ($request->filled('password')) {
            $user->update(['password' => $request['password']]);
        }

        Alert::success('Berhasil!', 'Data User Telah di Update!');
        return redirect('/admin_panel/adminManageUser');
    }


    public function delete($id)
    {
        $user = User::findOrFail($id);

        return view('/admin_panel/adminManageUser/', compact('user'));
    }

    // method untuk delete user
    public function destroy($id)
    {
        $deleteUser = User::findOrFail($id);

        if ($deleteUser->bookings->count() > 0) {
            Alert::error('Oops!', 'Anda tidak dapat menghapus user ini, karena data user telah terekam pada Booking');
            return redirect('/admin_panel/adminManageUser');
        } else {

            $deleteUser->delete();

            Alert::success('Berhasil!', 'Data User Telah Terhapus!');

            return redirect('/admin_panel/adminManageUser');
        }
    }
}