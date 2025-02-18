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
        'estado',
        'id_usuario'
    ];
    public function solicitudes(){
        //Una adopcion puede tener muchas solicitudes (1)
        return $this->hasMany(Solicitud::class);
    }

    public function reacciones(){
        //Una adopcion puede tener muchas reacciones (1)
        return $this->hasMany(Reaccion::class);
    }

}
