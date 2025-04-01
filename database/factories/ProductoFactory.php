<?php

namespace Database\Factories;

use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre'=>fake()->words(3, true),
            'descripcion'=>fake()->words(10, true),
            'precio'=>fake()->randomFloat(2, 1, 1000),
            'categoria_id'=>Categoria::find(1),
            'stock'=>fake()->numberBetween(1, 100),
            'imagen'=>null,
            'imagen2'=>null,
            'imagen3'=>null,
            'imagen4'=>null,
            'imagen5'=>null,
            'activo'=>fake()->boolean(),
        ];
    }
}
