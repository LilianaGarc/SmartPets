<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    use HasFactory;
    protected $table = 'publicaciones';

    public function comentarios(){
        //Una publicacion puede tener muchos comentarios (1)
        return $this->hasMany(Comentario::class);
    }

    public function reacciones(){
        //Una publicacion puede tener muchas reacciones (1)
        return $this->hasMany(Reaccion::class);
    }
}
