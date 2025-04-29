<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reaccion extends Model
{
    use HasFactory;
    protected $table = 'reacciones';

    public function publicacion(){
        return $this->belongsTo(Publicacion::class, 'publicacion_id');
    }

    public function adopcion(){
        //Varias reacciones pertenecen una adopcion (N)
        return $this->belongsTo(Adopcion::class);
    }

    public function user(){
        //Varias reacciones pertenecen un usuario (N)
        return $this->belongsTo(User::class, 'id_user');
    }
}
