<?php

namespace Database\Factories;
use App\Models\Ubicacion;
use App\Models\Veterinaria;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Veterinaria>
 */
class VeterinariaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->company,
            'nombre_veterinario' => $this->faker->name,
            'horario_apertura' => $this->faker->time('H:i', '08:00'),
            'horario_cierre' => $this->faker->time('H:i', '18:00'),
            'telefono' => $this->faker->phoneNumber,
            'whatsapp' => $this->faker->phoneNumber,
            'ubicacion_id' => Ubicacion::factory(),
        ];
    }
}