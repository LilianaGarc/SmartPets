<?php

namespace Database\Seeders;

use App\Models\Resenia;
use Illuminate\Database\Seeder;

class ReseniasTableSeeder extends Seeder
{
    public function run(): void
    {
        Resenia::factory()->count(10)->create();
    }
}
