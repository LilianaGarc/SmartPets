<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veterinaria extends Model
{
    use HasFactory;

    public function ubicacion(){
        //Una veterinaria tiene una ubicacion (1)
        return $this->hasOne(Ubicacion::class);
    }
}
