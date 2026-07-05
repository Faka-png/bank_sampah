<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    protected $table = 'warga';
    protected $primaryKey = 'id_warga';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id_warga', 'nama', 'alamat', 'email', 'password'];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_warga', 'id_warga');
    }
}