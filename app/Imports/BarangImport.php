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
        $barang = new Product();
        $barang->kode_barang = $row[0];
        $barang->nama_barang = $row[1];
        $barang->stok_barang = $row[2];
        $barang->status_barang = $row[3];
        $barang->gambar_barang = $row[4];

        return $barang;
    }
}
