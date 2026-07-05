<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    protected $table = 'detail_transaksi';
    protected $fillable = ['id_transaksi', 'id_jenis', 'berat', 'subtotal'];

    public function jenisSampah()
    {
        return $this->belongsTo(JenisSampah::class, 'id_jenis', 'id_jenis');
    }
}