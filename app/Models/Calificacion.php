<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    use HasFactory;
    protected $table = 'calificaciones';

    protected $fillable = [
        'id_user',
        'id_veterinaria',
        'calificacion',
        'opinion',
    ];

    public function User(){
        //Una calificacion pertenece a un usuario (1)
        return $this->belongsTo(User::class, 'id_user');
    }

    public function veterinaria(){
        //Una calificacion pertenece a una veterinaria (1)
        return $this->belongsTo(Veterinaria::class, 'id_veterinaria');
    }
}
