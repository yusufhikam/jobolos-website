<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register');
    }


    public function register(RegisterRequest $request)
    {


        // default ROLE is 'customer' because this is customer's register
        $customerRole = Role::where('name', 'customer')->first();

        // create / insert new data for customer

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
            'role_id' => $customerRole->id
        ]);

        // Flash success message
        Session::flash('status', 'success');
        Session::flash('message', 'Registrasi berhasil. Silakan login.');

        // redirect ke halaman login
        return redirect('/login')->with('success', 'Registrasi berhasil. Silakan login.');
    }
}
