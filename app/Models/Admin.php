<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'id_admin';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id_admin','nama', 'email', 'password'];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_admin', 'id_admin');
    }
}