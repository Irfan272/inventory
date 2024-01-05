<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_po',
        'id_sales',
        'tanggal_keluar',    
    ];

    public function Sales(){
        return $this->belongsTo(Sales::class, 'id_sales');
    }


    public function BarangKeluarDetail(){
        return $this->hasMany(BarangKeluarDetail::class, 'id_barangkeluar');
    }

    
}
