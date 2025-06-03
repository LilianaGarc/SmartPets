<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Adopcion;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    
    // Relaciones con otros modelos
    // Modelo Veterinaria
    public function veterinarias()
    {
        //Un usuario puede tener muchas veterinarias (1)
        return $this->hasMany(Veterinaria::class, 'id_user');
    }

    // Modelo Publicaciones
    public function publicaciones()
    {
        //Un usuario puede tener muchas publicaciones (1)
        return $this->hasMany(Publicacion::class);
    }

    // Modelo Comentarios
    public function comentarios()
    {
        //Un usuario puede tener muchos comentarios (1)
        return $this->hasMany(Comentario::class);
    }

    // Modelo Reacciones
    public function reacciones()
    {
        //Un usuario puede tener muchas reacciones (1)
        return $this->hasMany(Reaccion::class);
    }

    // Modelo Calificaciones
    public function calificaciones()
    {
        //Un usuario puede tener muchas calificaciones (1)
        return $this->hasMany(Calificacion::class, 'id_user');
    }

    // Modelo Reseñas
    public function resenias()
    {
        //Un usuario puede tener muchas reseñas (1)
        $this->hasMany(Resenia::class);
    }

    // Modelo Adopciones
    public function adopciones()
    {
        return $this->hasMany(Adopcion::class, 'id_usuario'); {
            //Un usuario puede tener muchas adopciones (1)
        }
    }

    // Modelo Productos
    public function productos()
    {
        //Un usuario puede tener muchos productos (1)
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

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'usertype',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
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
}
