<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'kd_barang',
        'nama_barang',
        'stok',
        'satuan',
        'harga',
    ];

    public function BarangMasukDetail(){
        return $this->hasMany(BarangMasukDetail::class, 'id_barang');
    }

    public function BarangKeluarDetail(){
        return $this->hasMany(BarangMasukDetail::class, 'id_barang');
    }



}
