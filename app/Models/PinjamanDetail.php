<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PinjamanDetail extends Model
{
    use HasFactory;

    function product()
    {
        return $this->belongsTo('App\Models\Product', 'id_barang', 'id');
    }

    function peminjaman()
    {
        return $this->belongsTo('App\Models\Peminjaman', 'id_peminjaman', 'id');
    }
}
