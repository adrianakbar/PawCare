<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController
{

    // Proses login
    public function login(Request $request)
    {
        // Validasi input form
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Kredensial login
        $credentials = $request->only('email', 'password');

        // Autentikasi pengguna
        if (Auth::attempt($credentials)) {
            // Redirect ke halaman home setelah berhasil login
            return redirect()->intended('/animal');
        }

        // Mengirimkan pesan error jika login gagal
        return redirect()->back()->with('error', 'Email atau password salah');
    }


    // Logout pengguna
    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Anda telah logout.');
    }
}
