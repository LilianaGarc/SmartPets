<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veterinaria extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'nombre_veterinario',
        'horario_apertura',
        'horario_cierre',
        'telefono',
        'imagen',
        'redes_sociales',
        'evaluacion',
    ];

    // convierte los json en array
    protected $casts = [
        'imagen' => 'array',
        'redes_sociales' => 'array',
    ];

    public function ubicacion(){
        //Una veterinaria tiene una ubicacion (1)
        return $this->hasOne(Ubicacion::class);
    }
}