<?php

namespace Database\Seeders;

use App\Models\Pregunta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PreguntasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pregunta::create(['texto_pregunta' => '¿Prefieres una mascota activa o tranquila?']);
        Pregunta::create(['texto_pregunta' => '¿Te gustaría una mascota que sea de tamaño pequeño, mediano o grande?']);
        Pregunta::create(['texto_pregunta' => '¿Estás dispuesto a dedicarle mucho tiempo al cuidado de tu mascota?']);
        Pregunta::create(['texto_pregunta' => '¿Prefieres una mascota que sea fácil de cuidar o que requiera más atención?']);
        Pregunta::create(['texto_pregunta' => '¿Te gustaría una mascota que se pueda tener en un espacio pequeño?']);
        Pregunta::create(['texto_pregunta' => '¿Prefieres una mascota que sea independiente o que requiera atención constante?']);
        Pregunta::create(['texto_pregunta' => '¿Es importante que tu mascota sea sociable con otras personas o animales?']);
        Pregunta::create(['texto_pregunta' => '¿Te gustaría una mascota que sea fácil de entrenar?']);
        Pregunta::create(['texto_pregunta' => '¿Prefieres una mascota que no necesite cuidados médicos frecuentes?']);
        Pregunta::create(['texto_pregunta' => '¿Estás buscando una mascota para tener dentro de tu casa o en el exterior?']);
    }
}
