<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\JenisSampah;
use App\Models\DetailTransaksi;
use Illuminate\Support\Facades\DB;

class WargaController extends Controller
{
    public function dashboard()
    {
        $id_warga = session('id_warga');
        $t_berat = Transaksi::where('id_warga', $id_warga)->sum('total_berat') ?? 0;
        $t_saldo = Transaksi::where('id_warga', $id_warga)->sum('total_saldo') ?? 0;
        
        $riwayat = Transaksi::where('id_warga', $id_warga)->orderBy('tanggal', 'desc')->get();
        $jenis_sampah = JenisSampah::all();

        return view('warga.dashboard', compact('t_berat', 't_saldo', 'riwayat', 'jenis_sampah'));
    }

    public function setorMandiri(Request $request)
    {
        $id_warga = session('id_warga');
        $jenis = JenisSampah::findOrFail($request->id_jenis);
        $total_saldo = $request->berat * $jenis->harga_perkg;

        // Auto ID Generator TRXXX
        $last = Transaksi::orderBy('id_transaksi', 'desc')->first();
        if ($last) {
            $angka = (int) substr($last->id_transaksi, 2) + 1;
            $id_transaksi = "TR" . sprintf("%03d", $angka);
        } else {
            $id_transaksi = "TR001";
        }

        DB::transaction(function () use ($id_transaksi, $id_warga, $request, $total_saldo) {
            Transaksi::create([
                'id_transaksi' => $id_transaksi,
                'id_warga' => $id_warga,
                'tanggal' => now()->format('Y-m-d'),
                'total_berat' => $request->berat,
                'total_saldo' => $total_saldo
            ]);

            DetailTransaksi::create([
                'id_transaksi' => $id_transaksi,
                'id_jenis' => $request->id_jenis,
                'berat' => $request->berat,
                'subtotal' => $total_saldo
            ]);
        });

        return redirect()->route('warga.dashboard')->with('status', 'sukses');
    }
}
