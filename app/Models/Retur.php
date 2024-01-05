<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retur extends Model
{
    use HasFactory;
    protected $fillable = [
        'no_retur',
        'id_sales',
        'tanggal_retur',    
    ];

    public function Sales(){
        return $this->belongsTo(Sales::class, 'id_sales');
    }


    public function ReturDetail(){
        return $this->hasMany(ReturDetail::class, 'id_retur');
    }
}
