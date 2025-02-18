<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Adopcion>
 */
class AdopcionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'contenido'=>fake()->words(10, true),
            'imagen' => fake()->filePath(),
            'visibilidad'=>fake()->boolean(1),
            'estado'=>fake()->randomElement(['pendiente','aceptado','rechazado']),
            'id_usuario' => fake()->numberBetween(1,70),
        ];
    }
}
