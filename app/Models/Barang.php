<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    use HasFactory;

    protected $table = 'data_barang';

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'stok_barang',
        'status_barang',
        'gambar_barang',
    ];
}
