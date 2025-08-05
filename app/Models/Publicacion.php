<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    use HasFactory;

    protected $table = 'publicaciones';

    protected $fillable = [
        'id_user',
        'visibilidad',
        'contenido',
        'imagen',
        'publicacion_original_id',
    ];

    public function publicacionOriginal()
    {
        return $this->belongsTo(Publicacion::class, 'publicacion_original_id');
    }
    public function comentarios()
    {
        return $this->hasMany(Comentario::class,'publicacion_id' );
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'publicacion_id');
    }

    public function reacciones()
    {
        return $this->hasMany(Reaccion::class, 'publicacion_id');
    }

    public function reaccionesUsuarioActual()
    {
        return $this->hasOne(Reaccion::class, 'publicacion_id')->where('id_user', auth()->id());
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

}
