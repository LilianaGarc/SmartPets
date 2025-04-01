<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Resenia;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PublicacionesTableSeeder::class,
            ComentariosTableSeeder::class,
            ReaccionesTableSeeder::class,
            UsersTableSeeder::class,
            VeterinariasTableSeeder::class,
            AdopcionesTableSeeder::class,
            EventosTableSeeder::class,
            MensajesTableSeeder::class,
            ChatsTableSeeder::class,
            CategoriasTableSeeder::class,
            ProductosTableSeeder::class,
            SolicitudesTableSeeder::class,
            UbicacionesTableSeeder::class,
            ReseniasTableSeeder::class,
        ]);
    }

}
