<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    use HasFactory;

    public function chat(){
        //Varios mensajes pertenecen un chat (N)
        return $this->belongsTo(Chat::class);
    }
}
