<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {


        return view('login');
    }

    public function authenticate(LoginRequest $request)
    {


        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $user = Auth::user();
            if ($user && $user->nama_role) {
                if ($user->nama_role->name === 'admin') {
                    // return redirect('/admin_panel/adminDashboard');
                    return redirect()->intended(RouteServiceProvider::ADMIN_HOME);
                } elseif ($user->nama_role->name === 'customer') {
                    // return redirect('/');
                    return redirect()->intended(RouteServiceProvider::CUSTOMER_HOME);
                }
            }

            // return redirect()->intended('/');
        }

        // cek apakah email ada di database

        $user = User::where('email', $credentials['email'])->first();

        if ($user) {
            // email benar, password salah
            Session::flash('status', 'failed');
            Session::flash('message', 'Login Gagal, Password Anda salah :(');
        } else {
            // email salah
            Session::flash('status', 'failed');
            Session::flash('message', 'Login Gagal, Email tidak ditemukan');
        }

        return redirect('/login');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
