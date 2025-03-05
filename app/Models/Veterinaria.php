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
        'id_ubicacion',
    ];

    // convierte los json en array
    protected $casts = [
        'imagen' => 'array',
        'redes_sociales' => 'array',
    ];

    public function ubicacion(){
        //Una veterinaria tiene una ubicacion (1)
        return $this->belongsTo(Ubicacion::class, 'id_ubicacion');
    }

    public function calificaciones(){
        //Una veterinaria tiene muchas calificaciones (1)
        return $this->hasMany(Calificacion::class, 'id_veterinaria');
    }

    public function getCalifiacionPromedio(){
        return $this->calificaciones()->avg('calificacion');
    }

    public function getNumeroCalificaciones(){
        return $this->calificaciones()->count();
    }
}