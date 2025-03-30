<?php

namespace Database\Factories;

use App\Models\Producto;
use App\Models\Resenia;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ReseniaFactory extends Factory
{
    protected $model = Resenia::class;

    public function definition(): array
    {
        return [
            'titulo' => $this->faker->word(),
            'contenido' => $this->faker->paragraph(),
            'producto_id' => Producto::factory(),
            'user_id' => User::factory(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'deleted_at' => null,
        ];
    }
}
