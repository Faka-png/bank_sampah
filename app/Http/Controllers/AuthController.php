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
        $credentials = $request->username; 
        $password = $request->password; 

        if ($role == 'pengguna') {
            $warga = DB::table('warga')->where('email', $credentials)->where('password', $password)->first();
            
            if ($warga) {
                // PERBAIKAN: Gunakan key session yang spesifik untuk warga ('nama_warga')
                session([
                    'id_warga'   => $warga->id_warga, 
                    'nama_warga' => $warga->nama, // Spesifik untuk warga
                    'role'       => 'pengguna'
                ]);
                
                return redirect()->route('warga.dashboard')->with('success', "Halo {$warga->nama}, Login Berhasil!");
            }
            
        } elseif ($role == 'admin') {
            $admin = DB::table('admin')->where('email', $credentials)->where('password', $password)->first();
            
            if ($admin) {
                // PERBAIKAN: Gunakan key session yang spesifik untuk admin ('nama_admin')
                session([
                    'id_admin'   => $admin->id_admin, 
                    'nama_admin' => $admin->nama, // Spesifik untuk admin
                    'email'      => $admin->email, 
                    'role'       => 'admin'
                ]);
                
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