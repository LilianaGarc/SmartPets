<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Adopcion;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    public function veterinarias()
    {
        return $this->hasMany(Veterinaria::class, 'id_user');
    }

    public function publicaciones()
    {
        return $this->hasMany(Publicacion::class);
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    public function reacciones()
    {
        return $this->hasMany(Reaccion::class);
    }

    public function calificaciones()
    {
        return $this->hasMany(Calificacion::class, 'id_user');
    }

    public function resenias()
    {
        return $this->hasMany(Resenia::class);
    }

    public function adopciones()
    {
        return $this->hasMany(Adopcion::class, 'id_usuario');
    }

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }

    public function mensajes()
    {
        return $this->hasMany(Mensaje::class, 'user_id');
    }

    public function chatsComoUsuario1()
    {
        return $this->hasMany(Chat::class, 'id_usuario_1');
    }

    public function chatsComoUsuario2()
    {
        return $this->hasMany(Chat::class, 'id_usuario_2');
    }

    public function chats()
    {
        return $this->chatsComoUsuario1->merge($this->chatsComoUsuario2);
    }

    protected $fillable = [
        'name',
        'email',
        'password',
        'usertype',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getEsAdminAttribute()
    {
        return $this->usertype === 'admin';
    }
}
