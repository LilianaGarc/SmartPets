<?php

namespace Database\Factories;
use App\Models\Veterinaria;
use App\Models\Ubicacion;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ubicacion>
 */
class UbicacionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'departamento' => $this->faker->randomElement([
                'Atlántida', 'Choluteca', 'Colón', 'Comayagua', 'Copán', 'Cortés',
                'El Paraíso', 'Francisco Morazán', 'Gracias a Dios', 'Intibucá',
                'Islas de la Bahía', 'La Paz', 'Lempira', 'Ocotepeque', 'Olancho',
                'Santa Bárbara', 'Valle', 'Yoro'
            ]),
            'ciudad' => $this->faker->city,
            'municipio' => $this->faker->city,
            'direccion' => $this->faker->address,
        ];
    }
}
