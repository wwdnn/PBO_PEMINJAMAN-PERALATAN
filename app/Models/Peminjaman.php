<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    function user()
    {
        return $this->belongsTo('App\Models\User', 'id_user', 'id');
    }

    function pinjaman_details()
    {
        return $this->hasMany('App\Models\PinjamanDetail', 'id_peminjaman', 'id');
    }

}
