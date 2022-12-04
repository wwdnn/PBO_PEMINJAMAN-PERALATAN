<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Barang;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');
        for ($i = 0; $i < 100; $i++) {
            \App\Models\Barang::create([
                'kode_barang' => $faker->unique()->regexify('[A-Z]{5}[0-9]{3}'),
                'nama_barang' => $faker->unique()->regexify('[A-Z]{20}[0-9]{3}'),
                'stok_barang' => $faker->numberBetween(1, 100),
                'status_barang' => $faker->randomElement(['TERSEDIA', 'HABIS', 'RUSAK', 'HILANG']),
            ]);
        }
    }
}
