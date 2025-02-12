<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reaccion extends Model
{
    use HasFactory;
    protected $table = 'reacciones';

    public function publicacion(){
        //Varias reacciones pertenecen una publicacion (N)
        return $this->belongsTo(Publicacion::class);
    }
}
