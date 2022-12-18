<?php

namespace App\Imports;

use App\Models\PetugasPeralatan;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;

class PetugasPeralatanImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $petugas = new PetugasPeralatan();
        $petugas->nama_petugas = $row[0];
        $petugas->username = $row[1];
        $petugas->password = Hash::make($row[2]);
        $petugas->email = $row[3];

        return $petugas;
    }
}
