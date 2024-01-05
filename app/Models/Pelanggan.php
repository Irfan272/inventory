<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_pelanggan',
        'nama_toko',
        'nama_kepalatoko',
        'alamat',
        'not_hp',
    ];

    public function BarangMasukDetail(){
        return $this->hasMany(BarangMasukDetail::class, 'id_pelanggan');
    }
}
