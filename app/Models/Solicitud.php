<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;
    protected $table = 'solicitudes';
    public function adopcion(){
        //Varios comentarios pertenecen una adopcion (N)
        return $this->belongsTo(Adopcion::class);
    }
}
