<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Adopcion;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    // Relaciones con otros modelos
    // Modelo Veterinaria

    public function veterinarias()
    {
        return $this->hasMany(Veterinaria::class, 'id_user');
    }

    public function isAdmin()
    {
        return $this->usertype === 'admin';
    }


    // Modelo Publicaciones
    public function publicaciones()
    {
        return $this->hasMany(Publicacion::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function hasLiked(Post $post)
    {
        return $this->likes()->where('post_id', $post->id)->exists();
    }


    // Modelo Comentarios
    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    // Modelo Reacciones
    public function reacciones()
    {
        return $this->hasMany(Reaccion::class);
    }

    // Modelo Calificaciones
    public function calificaciones()
    {
        return $this->hasMany(Calificacion::class, 'id_user');
    }

    // Modelo Reseñas
    public function resenias()
    {
        return $this->hasMany(Resenia::class);
    }

    // Modelo Adopciones
    public function adopciones()
    {
        return $this->hasMany(Adopcion::class, 'id_usuario');
    }

    // Modelo Productos
    public function productos()
    {
        return $this->hasMany(Producto::class);
    }

    // Modelo Participaciones
    public function participaciones()
    {
        // Un usuario puede tener muchas participaciones (1)
        return $this->hasMany(Participacion::class, 'id_user');
    }

    // Modelo Eventos
    public function eventos()
    {
        // Un usuario puede tener muchos eventos (1)
        return $this->hasMany(Evento::class, 'id_user');
    }

    public function eventosCreados(){
        // Un usuario puede crear muchos eventos (1)
        return $this->hasMany(Evento::class, 'id_user');
    }

    public function eventosParticipando(){
        // Un usuario puede participar en muchos eventos (1)
        return $this->belongsToMany(Evento::class, 'participaciones', 'id_user', 'evento_id');
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

    public function puntajes()
    {
        return $this->hasMany(Puntaje::class, 'id_usuario');
    }


    public function historias()
{
    return $this->hasMany(Historia::class);
}


    protected $fillable = [
        'name',
        'email',
        'password',
        'usertype',
        'telefono',
        'descripción',
        'direccion',
        'mascota_virtual',
        'nombre_mascota_virtual',
        'hambre_mascota_virtual',
        'felicidad_mascota_virtual',
        'recibir_notificaciones'
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

    // Tipo de usuario
    public function getEsAdminAttribute()
    {
        return $this->usertype === 'admin';
    }

    public function getEnLineaAttribute()
    {
        // Verifica si hay una sesión activa para este usuario
        return \DB::table('sessions')
            ->where('user_id', $this->id)
            ->where('last_activity', '>', now()->subMinutes(5)->timestamp)
            ->exists();
    }
}
