<?php

namespace Database\Factories;

use App\Models\prod_favorito;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class prod_favoritoFactory extends Factory
{
    protected $model = prod_favorito::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
