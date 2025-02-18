<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Solicitud>
 */
class SolicitudFactory extends Factory
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
                'comprobante' => fake()->filePath(),
                'id_usuario' => fake()->numberBetween(1,70),
                'id_adopcion' => fake()->numberBetween(1,300),
        ];
    }
}
