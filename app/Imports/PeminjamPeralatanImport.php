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
        return new User([
            'name' => $row[0],
            'NIM_NIDN' => $row[1],
            'status' => $row[2],
            'is_siswa' => $row[3],
        ]);
    }
}
