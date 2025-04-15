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
    public function publicaciones(){
        //Un usuario puede tener muchas publicaciones (1)
        return $this->hasMany(Publicacion::class);
    }

    public function comentarios(){
        //Un usuario puede tener muchos comentarios (1)
        return $this->hasMany(Comentario::class);
    }

    public function reacciones(){
        //Un usuario puede tener muchas reacciones (1)
        return $this->hasMany(Reaccion::class);
    }

    public function calificaciones(){
        //Un usuario puede tener muchas calificaciones (1)
        return $this->hasMany(Calificacion::class, 'id_usuario');
    }

    public function resenias()
    {
        //Un usuario puede tener muchas reseñas (1)
        $this->hasMany(Resenia::class);
    }


    public function adopciones()
    {
        return $this->hasMany(Adopcion::class, 'id_usuario');{
            //Un usuario puede tener muchas adopciones (1)
        }
    }

    public function productos()
    {
        //Un usuario puede tener muchos productos (1)
        return $this->hasMany(Producto::class);

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
}
