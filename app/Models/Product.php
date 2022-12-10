<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    use HasFactory;

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'stok_barang',
        'status_barang',
        'gambar_barang',
    ];

    public $timestamps = false;

    function pinjaman_details()
    {
        return $this->hasMany('App\Models\PinjamanDetail', 'id_barang', 'id');
    }
}
