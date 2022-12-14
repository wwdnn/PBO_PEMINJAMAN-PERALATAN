<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PetugasPeralatanImport;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PetugasPeralatan>
 */
class PetugasPeralatanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // import data from excel file
        $data = Excel::import(new PetugasPeralatanImport, 'public/petugas_peralatan.xlsx');

        return [
            'nama_petugas' => $data->nama_petugas,
            'username' => $data->username,
            'password' => $data->password
        ];
        
    }
}
