<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PeminjamPeralatanImport;

class PeminjamPeralatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // import data from excel file
        Excel::import(new PeminjamPeralatanImport, 'public/dummy/peminjam_peralatan.xlsx');
    }
}
