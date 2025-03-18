<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reaccion>
 */
class ReaccionFactory extends Factory
{
    /**
     * Define the model's default state.
     * $table->string('tipo');
     * $table->integer('id_usuario');
     * $table->integer('id_publicacion');
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tipo'=>fake()->randomElement(['like', 'love', 'angry', 'sad']),
            'id_user' => fake()->numberBetween(1,70),
            'publicacion_id' => fake()->numberBetween(1,300),
        ];
    }
}
