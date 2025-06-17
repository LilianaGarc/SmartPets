<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Adopcion extends Model
{
    use HasFactory;
    protected $table = 'adopciones';
    protected $fillable = [
        'contenido',
        'imagen',
        'imagenes_secundarias',
        'visibilidad',
        'tipo_mascota',
        'nombre_mascota',
        'fecha_nacimiento',
        'raza_mascota',
        'ubicacion_mascota',
        'id_usuario',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function solicitudes(){
        //Una adopcion puede tener muchas solicitudes (1)
        return $this->hasMany(Solicitud::class, 'id_adopcion');
    }

    public function solicitudAceptada()
    {
        return $this->hasOne(Solicitud::class, 'id_adopcion')->where('estado', 'aceptada');
    }




}
