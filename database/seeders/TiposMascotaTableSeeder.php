<?php

namespace Database\Seeders;

use App\Models\TipoMascota;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TiposMascotaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoMascota::create(['nombre_tipo' => 'Perro']);
        TipoMascota::create(['nombre_tipo' => 'Gato']);
        TipoMascota::create(['nombre_tipo' => 'Conejo']);
        TipoMascota::create(['nombre_tipo' => 'Tortuga']);
    }
}
