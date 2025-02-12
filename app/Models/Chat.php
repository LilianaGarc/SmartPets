<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    public function mensajes(){
        //Un chat puede tener muchos mensajes (1)
        return $this->hasMany(Mensaje::class);
    }
}
