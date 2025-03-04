<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriasTableSeeder extends Seeder
{
    public function run(): void
    {
        Categoria::factory(100)->create();
    }
}
