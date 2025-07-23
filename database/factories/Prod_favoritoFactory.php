<?php

namespace Database\Factories;

use App\Models\prod_favorito;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class Prod_favoritoFactory extends Factory
{
    protected $model = prod_favorito::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'producto_id' => Producto::factory(),
        ];
    }
}
