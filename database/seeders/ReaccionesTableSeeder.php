<?php

namespace Database\Seeders;

use App\Models\Reaccion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReaccionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Reaccion::factory(70)->create();

    }
}
