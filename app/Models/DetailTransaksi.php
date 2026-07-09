<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    protected $table = 'detail_transaksi';

    // PERBAIKAN: Matikan fitur otomatis timestamps Laravel
    public $timestamps = false;

    protected $fillable = ['id_transaksi', 'id_jenis', 'berat', 'subtotal'];

    public function jenisSampah()
    {
        return $this->belongsTo(JenisSampah::class, 'id_jenis', 'id_jenis');
    }
}