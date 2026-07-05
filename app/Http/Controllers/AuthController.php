<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (session('role') == 'admin') return redirect()->route('admin.dashboard');
        if (session('role') == 'pengguna') return redirect()->route('warga.dashboard');
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'role' => 'required',
            'username' => 'required',
            'password' => 'required'
        ]);

        $role = $request->role;
        $credentials = $request->username; // Mengambil input dari form (bisa berisi email)
        $password = $request->password; 

        if ($role == 'pengguna') {
            $warga = DB::table('warga')->where('email', $credentials)->where('password', $password)->first();
            if ($warga) {
                session(['id_warga' => $warga->id_warga, 'nama' => $warga->nama, 'role' => 'pengguna']);
                return redirect()->route('warga.dashboard')->with('success', "Halo {$warga->nama}, Login Berhasil!");
            }
        } elseif ($role == 'admin') {
            // PERBAIKAN: Mengubah 'username' menjadi 'email' agar sesuai dengan kolom di database
            $admin = DB::table('admin')->where('email', $credentials)->where('password', $password)->first();
            if ($admin) {
                // Sesuaikan session untuk menyimpan 'email', bukan 'username'
                session(['id_admin' => $admin->id_admin, 'email' => $admin->email, 'role' => 'admin']);
                return redirect()->route('admin.dashboard')->with('success', 'Login Admin Berhasil!');
            }
        }

        return redirect()->back()->with('error', 'Username/Email atau Password salah!');
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('login');
    }
}