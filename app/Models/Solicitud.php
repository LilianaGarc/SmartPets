<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    public function adopcion(){
        //Varios comentarios pertenecen una adopcion (N)
        return $this->belongsTo(Adopcion::class);
    }
}
