<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    public function publicacion(){
        //Varios comentarios pertenecen una publicacion (N)
        return $this->belongsTo(Publicacion::class);
    }


}
