<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id_transaksi', 'id_warga', 'tanggal', 'total_berat', 'total_saldo'];

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'id_warga', 'id_warga');
    }

    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'id_transaksi', 'id_transaksi');
    }
}