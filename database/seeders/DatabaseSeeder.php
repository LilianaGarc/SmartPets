<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Resenia;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            TiposMascotaTableSeeder::class,
            PreguntasTableSeeder::class,
            RespuestasTableSeeder::class,
            UsersTableSeeder::class,
            CategoriasTableSeeder::class,
        ]);
    }
}
