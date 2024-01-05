<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_barang',
        'id_retur',
        'jumlah',
        'satuan',
        'harga', 
    ];

    public function Barang(){
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    public function Retur(){
        return $this->belongsTo(Retur::class, 'id_retur');
    }
}
