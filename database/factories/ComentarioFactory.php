<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comentario>
 */
class ComentarioFactory extends Factory
{
    /**
     * Define the model's default state.
     * $table->string('contenido');
     * $table->integer('id_usuario');
     * $table->integer('id_publicacion');
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'contenido'=>fake()->words(10, true),
            'id_user' => fake()->numberBetween(1,70),
            'id_publicacion' => fake()->numberBetween(1,300),
        ];
    }
}
