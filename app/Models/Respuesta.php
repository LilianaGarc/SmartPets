<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    use HasFactory;

    public function pregunta()
    {
        return $this->belongsTo(Pregunta::class);
    }

    public function tipoMascota()
    {
        return $this->belongsTo(TipoMascota::class, 'tipo_mascota_id');
    }
}
