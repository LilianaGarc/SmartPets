<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    use HasFactory;

    protected $fillable = ['texto', 'fecha', 'estado', 'id_chat', 'user_id', 'tema', 'imagen'];

    public function chat()
    {
        return $this->belongsTo(Chat::class, 'id_chat');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
