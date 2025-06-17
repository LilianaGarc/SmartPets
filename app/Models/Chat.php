<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = ['id_usuario_1', 'id_usuario_2'];

    public function mensajes()
    {
        return $this->hasMany(Mensaje::class, 'id_chat');
    }

    public function usuario1()
    {
        return $this->belongsTo(User::class, 'id_usuario_1');
    }

    public function usuario2()
    {
        return $this->belongsTo(User::class, 'id_usuario_2');
    }
}
