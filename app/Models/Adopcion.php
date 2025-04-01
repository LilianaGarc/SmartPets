<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adopcion extends Model
{
    use HasFactory;
    protected $table = 'adopciones';
    protected $fillable = [
        'contenido',
        'imagen',
        'visibilidad',
        'tipo_mascota',
        'nombre_mascota',
        'edad_mascota',
        'raza_mascota',
        'ubicacion_mascota',
    ];
    public function solicitudes(){
        //Una adopcion puede tener muchas solicitudes (1)
        return $this->hasMany(Solicitud::class, 'id_adopcion');
    }

    public function reacciones(){
        //Una adopcion puede tener muchas reacciones (1)
        return $this->hasMany(Reaccion::class);
    }

}
