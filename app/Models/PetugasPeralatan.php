<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class PetugasPeralatan extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $guard = 'petugas_peralatan';

    protected $table = 'petugas_peralatan';

    protected $fillable = [
        'nama_petugas',
        'username',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
