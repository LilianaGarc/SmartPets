<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;
    protected $table = 'solicitudes';
    protected $fillable = [
        'contenido',
        'experiencia',
        'espacio',
        'gastos_veterinarios',
    ];
    public function adopcion(){
        //Varios solicitudes pertenecen una adopcion (N)
        return $this->belongsTo(Adopcion::class, 'id_adopcion');
    }
}
