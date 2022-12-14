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
        return new PetugasPeralatan([
            'nama_petugas' => $row[0],
            'username' => $row[1],
            'password' => Hash::make($row[2])
        ]);
    }
}
