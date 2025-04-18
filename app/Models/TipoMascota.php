<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoMascota extends Model
{
    use HasFactory;
    protected $table = 'tipos_mascotas';

    public function respuestas()
    {
        return $this->hasMany(Respuesta::class);
    }
}
