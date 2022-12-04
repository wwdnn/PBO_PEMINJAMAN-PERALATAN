<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            // nama_petugas
            'nama_petugas' => 'John Doe',
            // username
            'username' => 'johndoe',
            // create hashed password
            'password' => 'johndoe123'
        ];
    }
}
