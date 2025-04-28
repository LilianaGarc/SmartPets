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
        return $this->hasMany(Reaccion::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

}
