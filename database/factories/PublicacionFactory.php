<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Publicacion>
 */
class PublicacionFactory extends Factory
{
    /**
     * Define the model's default state.
     * $table->string('contenido');
     * $table->string('imagen')->nullable();
     * $table->boolean('visibilidad');
     * $table->integer('id_usuario');
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'contenido'=>fake()->words(10, true),
            'imagen' => fake()->filePath(),
            'visibilidad'=>fake()->randomElement(['publico', 'privado']),
            'id_user' => fake()->numberBetween(1,70),
        ];
    }
}
