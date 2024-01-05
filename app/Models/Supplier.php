<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'kd_supplier',
        'nama_supplier',
        'alamat',
        'no_telpon',
    ];

    public function BarangMasuk(){
        return $this->hasMany(BarangMasuk::class, 'id_supplier');
    }
   
}
