<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warga;
use App\Models\Transaksi;
use App\Models\JenisSampah;
use App\Models\DetailTransaksi;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $hitung_warga = Warga::count();
        $hitung_berat = Transaksi::sum('total_berat') ?? 0;
        $hitung_saldo = Transaksi::sum('total_saldo') ?? 0;

        return view('admin.dashboard', compact('hitung_warga', 'hitung_berat', 'hitung_saldo'));
    }

    public function sampahIndex()
    {
        $jenis_sampah = JenisSampah::all();
        return view('admin.sampah', compact('jenis_sampah'));
    }

    public function sampahStore(Request $request)
    {
        $request->validate([
            'id_jenis' => 'required|unique:jenis_sampah,id_jenis',
            'nama_sampah' => 'required',
            'harga_perkg' => 'required|numeric'
        ]);

        JenisSampah::create($request->all());
        return redirect()->route('admin.sampah')->with('status', 'sukses');
    }

    public function transaksiIndex()
    {
        $transaksi = Transaksi::with('warga')->get();
        return view('admin.transaksi_index', compact('transaksi'));
    }

    public function transaksiCreate()
    {
        $warga = Warga::all();
        $jenis_sampah = JenisSampah::all();
        return view('admin.transaksi_create', compact('warga', 'jenis_sampah'));
    }

    public function transaksiStore(Request $request)
    {
        $jenis = JenisSampah::find($request->id_jenis);
        $subtotal = $request->berat * $jenis->harga_perkg;

        DB::transaction(function () use ($request, $subtotal) {
            Transaksi::create([
                'id_transaksi' => $request->id_transaksi,
                'id_warga' => $request->id_warga,
                'tanggal' => $request->tanggal,
                'total_berat' => $request->berat,
                'total_saldo' => $subtotal,
            ]);

            DetailTransaksi::create([
                'id_transaksi' => $request->id_transaksi,
                'id_jenis' => $request->id_jenis,
                'berat' => $request->berat,
                'subtotal' => $subtotal,
            ]);
        });

        return redirect()->route('admin.transaksi')->with('status', 'sukses');
    }

    public function transaksiDetail($id)
    {
        $master = Transaksi::with('warga')->findOrFail($id);
        $details = DetailTransaksi::with('jenisSampah')->where('id_transaksi', $id)->get();
        return view('admin.transaksi_detail', compact('master', 'details'));
    }

    // Tambahkan fungsi ini di dalam class AdminController

public function wargaIndex()
{
    // Mengambil semua data dari tabel warga menggunakan Eloquent Model
    $warga = Warga::all(); 
    return view('admin.warga', compact('warga'));
}

public function wargaStore(Request $request)
{
    // Validasi input data form
    $request->validate([
        'id_warga' => 'required|unique:warga,id_warga',
        'nama'     => 'required',
        'alamat'   => 'required',
        'no_hp'    => 'required',
        'email'    => 'required|email|unique:warga,email',
        'password' => 'required|min:6'
    ]);

    // Menyimpan data ke database
    Warga::create([
        'id_warga' => $request->id_warga,
        'nama'     => $request->nama,
        'alamat'   => $request->alamat,
        'no_hp'    => $request->no_hp,
        'email'    => $request->email,
        'password' => $request->password // Catatan: Sebaiknya gunakan bcrypt($request->password) jika ingin di-enkripsi
    ]);

    return redirect()->route('admin.warga')->with('success', 'Data warga baru telah ditambahkan.');
}
}