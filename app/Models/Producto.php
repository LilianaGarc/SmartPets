<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @var int|mixed
     */
    protected $fillable = ['nombre','descripcion','precio','categoria_id','stock','user_id','imagen','imagen2','imagen3',
        'imagen4', 'imagen5','activo'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function resenias(): HasMany
    {
        return $this->hasMany(Resenia::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subcategoria()
    {
        return $this->belongsTo(Subcategoria::class);
    }

}
