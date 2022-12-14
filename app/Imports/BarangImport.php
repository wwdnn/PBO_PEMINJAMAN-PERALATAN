<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class BarangImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'kode_barang' => $row[0],
            'nama_barang' => $row[1],
            'stok_barang' => $row[2],
            'status_barang' => $row[3],
            'gambar_barang' => $row[4],
        ]); 
    }
}
