<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Evento>
 */
class EventoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'titulo' => $this->faker->name(),
            'descripcion' => $this->faker->text(),
            'fecha' => $this->faker->date(),
            'telefono' => $this->faker->phoneNumber(),
            'imagen' => $this->faker->image(),
        ];
    }
}
