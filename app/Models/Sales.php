<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'alamat',
        'not_hp',
    ];

    public function Retur(){
        return $this->hasMany(Retur::class, 'id_sales');
    }

    public function BarangKeluar(){
        return $this->hasMany(BarangKeluar::class, 'id_sales');
    }
}
