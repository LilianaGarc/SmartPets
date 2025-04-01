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
        'id_ubicacion',
    ];

    public function ubicacion(){
        //Una veterinaria tiene una ubicacion (1)
        return $this->belongsTo(Ubicacion::class, 'id_ubicacion');
    }

    public function imagenes() {
        return $this->hasMany(Imagen::class, 'id_veterinaria');
    }

    public function redes() {
        return $this->hasMany(RedSocial::class,'id_veterinaria');
    }

    public function calificaciones(){
        //Una veterinaria tiene muchas calificaciones (1)
        return $this->hasMany(Calificacion::class, 'id_veterinaria');
    }

    public function getCalificacionPromedioAttribute(){
        return $this->calificaciones()->avg('calificacion') ?? 0;
    }

    public function getNumeroCalificacionesAttribute(){
        return $this->calificaciones()->count();
    }
}