<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    function pinjaman_details()
    {
        return $this->hasMany('App\Models\PinjamanDetail', 'id_barang', 'id');
    }
}
