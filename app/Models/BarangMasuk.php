<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_po',
        'id_supplier',
        'tanggal_masuk',    
    ];

    public function Supplier(){
        return $this->belongsTo(Supplier::class, 'id_supplier', 'id');
    }

    public function BarangMasukDetail(){
        return $this->hasMany(BarangMasukDetail::class, 'id_barangmasuk', 'id');
    }
}
