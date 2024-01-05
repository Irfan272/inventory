<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluarDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_barang',
        'id_barangkeluar',
        'jumlah',
        'satuan',
        'harga', 
    ];

    public function Barang(){
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    public function BarangKeluar(){
        return $this->belongsTo(BarangKeluar::class, 'id_barangkeluar');
    }

  
}
