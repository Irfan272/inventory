<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasukDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_barang',
        'id_barangmasuk',
        'jumlah',
        'satuan',
        'harga', 
    ];

    public function Barang(){
        return $this->belongsTo(Barang::class, 'id_barang', 'id');
    }

    public function BarangMasuk(){
        return $this->belongsTo(BarangMasuk::class, 'id_barangmasuk', 'id');
    }
}
