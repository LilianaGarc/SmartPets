<?php

namespace Database\Seeders;

use App\Models\Adopcion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdopcionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Adopcion::factory(10)->create();
    }
}
