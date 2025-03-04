<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

     protected $table = 'eventos';

     protected $fillable = ['titulo', 'descripcion','telefono', 'fecha', 'imagen'];

     public function Evento(){

         return $this->belongsTo(User::class);
     }

     public function User(){

         return $this->belongsTo(User::class);
     }



}
