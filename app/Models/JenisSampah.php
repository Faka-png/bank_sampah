<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisSampah extends Model
{
    protected $table = 'jenis_sampah';
    protected $primaryKey = 'id_jenis';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id_jenis', 'nama_sampah', 'harga_perkg'];
}