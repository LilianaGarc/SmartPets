<?php

namespace Database\Seeders;

use App\Models\Respuesta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RespuestasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Respuestas para la primera pregunta: ¿Prefieres una mascota activa o tranquila?
        Respuesta::create(['pregunta_id' => 1, 'texto_respuesta' => 'Prefiero una mascota activa', 'tipo_mascota_id' => 1]); // Perro
        Respuesta::create(['pregunta_id' => 1, 'texto_respuesta' => 'Prefiero una mascota tranquila', 'tipo_mascota_id' => 2]); // Gato
        Respuesta::create(['pregunta_id' => 1, 'texto_respuesta' => 'Prefiero una mascota moderadamente activa', 'tipo_mascota_id' => 3]); // Conejo
        Respuesta::create(['pregunta_id' => 1, 'texto_respuesta' => 'Prefiero una mascota que sea relajada pero juguetona', 'tipo_mascota_id' => 4]); // Tortuga

        // Respuestas para la segunda pregunta: ¿Te gustaría una mascota que sea de tamaño pequeño, mediano o grande?
        Respuesta::create(['pregunta_id' => 2, 'texto_respuesta' => 'Prefiero una mascota pequeña', 'tipo_mascota_id' => 4]); // Tortuga
        Respuesta::create(['pregunta_id' => 2, 'texto_respuesta' => 'Prefiero una mascota mediana', 'tipo_mascota_id' => 3]); // Conejo
        Respuesta::create(['pregunta_id' => 2, 'texto_respuesta' => 'Prefiero una mascota grande', 'tipo_mascota_id' => 1]); // Perro
        Respuesta::create(['pregunta_id' => 2, 'texto_respuesta' => 'Me gustaría una mascota de tamaño mediano o pequeño', 'tipo_mascota_id' => 2]); // Gato

        // Respuestas para la tercera pregunta: ¿Estás dispuesto a dedicarle mucho tiempo al cuidado de tu mascota?
        Respuesta::create(['pregunta_id' => 3, 'texto_respuesta' => 'Sí, quiero dedicarle tiempo', 'tipo_mascota_id' => 1]); // Perro
        Respuesta::create(['pregunta_id' => 3, 'texto_respuesta' => 'No, prefiero algo que requiera menos atención', 'tipo_mascota_id' => 4]); // Tortuga
        Respuesta::create(['pregunta_id' => 3, 'texto_respuesta' => 'Depende de la mascota', 'tipo_mascota_id' => 2]); // Gato
        Respuesta::create(['pregunta_id' => 3, 'texto_respuesta' => 'Estoy dispuesto a dedicarle el tiempo necesario', 'tipo_mascota_id' => 3]); // Conejo

        // Respuestas para la cuarta pregunta: ¿Prefieres una mascota que sea fácil de cuidar o que requiera más atención?
        Respuesta::create(['pregunta_id' => 4, 'texto_respuesta' => 'Prefiero una mascota fácil de cuidar', 'tipo_mascota_id' => 4]); // Tortuga
        Respuesta::create(['pregunta_id' => 4, 'texto_respuesta' => 'Prefiero una mascota que requiera más atención', 'tipo_mascota_id' => 1]); // Perro
        Respuesta::create(['pregunta_id' => 4, 'texto_respuesta' => 'Prefiero que sea fácil de cuidar pero no tan independiente', 'tipo_mascota_id' => 2]); // Gato
        Respuesta::create(['pregunta_id' => 4, 'texto_respuesta' => 'Prefiero una mascota que no necesite mucho cuidado, pero que sea cariñosa', 'tipo_mascota_id' => 3]); // Conejo

        // Respuestas para la quinta pregunta: ¿Te gustaría una mascota que se pueda tener en un espacio pequeño?
        Respuesta::create(['pregunta_id' => 5, 'texto_respuesta' => 'Sí, me gustaría una mascota para espacios pequeños', 'tipo_mascota_id' => 4]); // Tortuga
        Respuesta::create(['pregunta_id' => 5, 'texto_respuesta' => 'Prefiero una mascota que necesite espacio', 'tipo_mascota_id' => 1]); // Perro
        Respuesta::create(['pregunta_id' => 5, 'texto_respuesta' => 'Me gustaría algo pequeño pero más activo', 'tipo_mascota_id' => 2]); // Gato
        Respuesta::create(['pregunta_id' => 5, 'texto_respuesta' => 'Me da igual el espacio necesario para la mascota', 'tipo_mascota_id' => 3]); // Conejo

        // Respuestas para la sexta pregunta: ¿Prefieres una mascota que sea independiente o que requiera atención constante?
        Respuesta::create(['pregunta_id' => 6, 'texto_respuesta' => 'Prefiero una mascota independiente', 'tipo_mascota_id' => 2]); // Gato
        Respuesta::create(['pregunta_id' => 6, 'texto_respuesta' => 'Prefiero una mascota que requiera atención constante', 'tipo_mascota_id' => 1]); // Perro
        Respuesta::create(['pregunta_id' => 6, 'texto_respuesta' => 'No me importa, depende de la mascota', 'tipo_mascota_id' => 3]); // Conejo
        Respuesta::create(['pregunta_id' => 6, 'texto_respuesta' => 'Prefiero que sea más independiente pero cariñosa', 'tipo_mascota_id' => 4]); // Tortuga

        // Respuestas para la séptima pregunta: ¿Es importante que tu mascota sea sociable con otras personas o animales?
        Respuesta::create(['pregunta_id' => 7, 'texto_respuesta' => 'Sí, quiero que sea sociable', 'tipo_mascota_id' => 1]); // Perro
        Respuesta::create(['pregunta_id' => 7, 'texto_respuesta' => 'Prefiero que sea reservada', 'tipo_mascota_id' => 2]); // Gato
        Respuesta::create(['pregunta_id' => 7, 'texto_respuesta' => 'No me importa si es sociable', 'tipo_mascota_id' => 3]); // Conejo
        Respuesta::create(['pregunta_id' => 7, 'texto_respuesta' => 'Prefiero que sea sociable pero no demasiado', 'tipo_mascota_id' => 4]); // Tortuga

        // Respuestas para la octava pregunta: ¿Te gustaría una mascota que sea fácil de entrenar?
        Respuesta::create(['pregunta_id' => 8, 'texto_respuesta' => 'Sí, prefiero que sea fácil de entrenar', 'tipo_mascota_id' => 1]); // Perro
        Respuesta::create(['pregunta_id' => 8, 'texto_respuesta' => 'No, no me importa si es difícil de entrenar', 'tipo_mascota_id' => 2]); // Gato
        Respuesta::create(['pregunta_id' => 8, 'texto_respuesta' => 'Depende de la mascota', 'tipo_mascota_id' => 3]); // Conejo
        Respuesta::create(['pregunta_id' => 8, 'texto_respuesta' => 'Prefiero una mascota que sea relativamente fácil de entrenar', 'tipo_mascota_id' => 4]); // Tortuga

        // Respuestas para la novena pregunta: ¿Prefieres una mascota que no necesite cuidados médicos frecuentes?
        Respuesta::create(['pregunta_id' => 9, 'texto_respuesta' => 'Sí, prefiero que no necesite muchos cuidados médicos', 'tipo_mascota_id' => 4]); // Tortuga
        Respuesta::create(['pregunta_id' => 9, 'texto_respuesta' => 'Prefiero una mascota que necesite atención médica', 'tipo_mascota_id' => 1]); // Perro
        Respuesta::create(['pregunta_id' => 9, 'texto_respuesta' => 'No me importa mucho los cuidados médicos', 'tipo_mascota_id' => 2]); // Gato
        Respuesta::create(['pregunta_id' => 9, 'texto_respuesta' => 'Prefiero no tener que ir mucho al veterinario', 'tipo_mascota_id' => 3]); // Conejo

        // Respuestas para la décima pregunta: ¿Estás buscando una mascota para tener dentro de tu casa o en el exterior?
        Respuesta::create(['pregunta_id' => 10, 'texto_respuesta' => 'Dentro de mi casa', 'tipo_mascota_id' => 2]); // Gato
        Respuesta::create(['pregunta_id' => 10, 'texto_respuesta' => 'En el exterior', 'tipo_mascota_id' => 1]); // Perro
        Respuesta::create(['pregunta_id' => 10, 'texto_respuesta' => 'Me da igual', 'tipo_mascota_id' => 3]); // Conejo
        Respuesta::create(['pregunta_id' => 10, 'texto_respuesta' => 'Prefiero una mascota que se pueda tener en ambos lugares', 'tipo_mascota_id' => 4]); // Tortuga
    }
}
