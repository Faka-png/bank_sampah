<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    protected $table = 'warga';
    protected $primaryKey = 'id_warga';
    public $incrementing = false;
    protected $keyType = 'string';

    // PERBAIKAN 1: Matikan fitur otomatis timestamps Laravel
    public $timestamps = false;

    // PERBAIKAN 2: Tambahkan 'no_hp' ke dalam array agar bisa disimpan ke database
    protected $fillable = ['id_warga', 'nama', 'alamat', 'no_hp', 'email', 'password'];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_warga', 'id_warga');
    }
}