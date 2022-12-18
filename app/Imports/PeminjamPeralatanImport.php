<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class PeminjamPeralatanImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user = new User();
        $user->name = $row[0];
        $user->NIM_NIDN = $row[1];
        $user->status = $row[2];
        $user->is_siswa = $row[3];

        return $user;
    }
}
