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
    ];


    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
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
