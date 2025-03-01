<?php

namespace Database\Factories;

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
            'categoria_id'=>fake()->numberBetween(1, 10),
            'stock'=>fake()->numberBetween(1, 100),
            'imagen'=>fake()->imageUrl(640, 480, 'animals', true),
            'imagen2'=>fake()->imageUrl(640, 480, 'animals', true),
            'imagen3'=>fake()->imageUrl(640, 480, 'animals', true),
            'imagen4'=>fake()->imageUrl(640, 480, 'animals', true),
            'imagen5'=>fake()->imageUrl(640, 480, 'animals', true),
            'activo'=>fake()->boolean(),
        ];
    }
}
