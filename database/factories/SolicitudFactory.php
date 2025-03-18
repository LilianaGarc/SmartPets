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
            'contenido' => fake()->words(10, true),
            'comprobante' => fake()->filePath(),
            'id_usuario' => fake()->numberBetween(1, 70),
            'id_adopcion' => fake()->numberBetween(1, 300),
            'experiencia' => fake()->randomElement(['Sí', 'No']),
            'vivienda' => fake()->randomElement(['Casa', 'Departamento']),
            'espacio' => fake()->randomElement(['Sí', 'No']),
            'otros_animales' => fake()->randomElement(['Sí', 'No']),
            'animales' => fake()->optional()->sentence(),
            'tiempo' => fake()->numberBetween(1, 24),
            'gastos_veterinarios' => fake()->randomElement(['Sí', 'No']),
        ];

    }
}
