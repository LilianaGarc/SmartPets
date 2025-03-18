<?php

namespace Database\Seeders;

use App\Models\Veterinaria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VeterinariasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Veterinaria::factory(50)->create();
    }
}
