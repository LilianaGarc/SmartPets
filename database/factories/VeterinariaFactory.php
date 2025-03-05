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
        $horas = ['08:00','08:30','09:00','09:30','10:00','10:30','11:00','11:30','12:00','12:30',
                  '13:00','13:30','14:00','14:30','15:00','15:30','16:00','16:30','17:00','17:30','18:00'
        ];

        // Seleccionar aleatoriamente la hora de apertura
        $horario_apertura = $this->faker->randomElement(array_slice($horas, 0, -1));

        // Filtrar solo las horas mayores a la de apertura
        $horas_validas_cierre = array_filter($horas, fn($hora) => $hora > $horario_apertura);

        // Seleccionar aleatoriamente la hora de cierre
        $horario_cierre = $this->faker->randomElement($horas_validas_cierre);
        return [
            'nombre' => $this->faker->company,
            'nombre_veterinario' => $this->faker->name,
            'horario_apertura' => $horario_apertura,
            'horario_cierre' => $horario_cierre,
            'telefono' => $this->faker->randomElement(['2', '9', '8', '3']) . $this->faker->numerify('#######'),
            'id_ubicacion' => Ubicacion::factory(),
            'evaluacion' => $this->faker->randomFloat(1, 0, 5),
        ];
    }
}