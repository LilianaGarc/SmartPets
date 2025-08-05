<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Subcategoria;
use Illuminate\Database\Seeder;

class SubcategoriaTableSeeder extends Seeder
{
    public function run(): void
    {
        $subcategorias = ['Juguetes', 'Accesorios','Alimento','Higiene'];

        Categoria::all()->each(function ($categoria) use ($subcategorias) {
            foreach ($subcategorias as $nombre) {
                Subcategoria::create([
                    'nombre' => $nombre,
                    'categoria_id' => $categoria->id
                ]);
            }
        });
    }
}
