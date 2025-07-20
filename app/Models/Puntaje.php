<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puntaje extends Model
{
    use HasFactory;
    protected $table = 'puntajes';

    protected $fillable = ['id_usuario', 'puntaje'];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
