<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\Product as Barang;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('petugas_peralatan')->insert([
            'nama_petugas' => 'John Doe',
            'username' => 'johndoe',
            'password' => Hash::make('johndoe123'),
        ]);

        Barang::factory()->count(1000)->create();
    }
}
