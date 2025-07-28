<?php

namespace Database\Factories;

use App\Models\Categoria;
use App\Models\Subcategoria;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class SubcategoriaFactory extends Factory
{
    protected $model = Subcategoria::class;

    public function definition(): array
    {
        return [
            'nombre' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'categoria_id' => Categoria::factory(),
        ];
    }
}
