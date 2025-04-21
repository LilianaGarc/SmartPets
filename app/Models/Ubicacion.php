<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    use HasFactory;
    protected $table = 'ubicaciones';

    protected $fillable = [
        'direccion',
        'ciudad',
        'departamento',
        'municipio',
        'latitud',
        'longitud',
    ];

    public function veterinarias(){
        //Una ubicaion pertenece a una veterinaria (1)
        return $this->hasMany(Veterinaria::class, 'id_ubicacion');
    }
}