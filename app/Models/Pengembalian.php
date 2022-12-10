<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'id_barang', 'id');
    }

    public function petugas_peralatan()
    {
        return $this->belongsTo('App\Models\PetugasPeralatan', 'id_petugas_peralatan', 'id');
    }
}
