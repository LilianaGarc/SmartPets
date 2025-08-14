<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriasTableSeeder extends Seeder
{
    public function run(): void
    {
        Categoria::create([
            'nombre' => 'Perros',
            'descripcion' => 'Productos para Perros'
        ]);

        Categoria::create([
            'nombre' => 'Gatos',
            'descripcion' => 'Productos para Gatos'
        ]);

        Categoria::create([
            'nombre' => 'Conejos',
            'descripcion' => 'Productos para Conejos'
        ]);

        Categoria::create([
            'nombre' => 'Tortugas',
            'descripcion' => 'Productos para Tortugas'
        ]);

        Categoria::create([
            'nombre' => 'Peces',
            'descripcion' => 'Productos para Peces'
        ]);

        Categoria::create([
            'nombre' => 'Otro',
            'descripcion' => 'Productos para otra categoría de mascotas'
        ]);

    }
}
