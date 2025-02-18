<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['nombre','descripcion','precio','categoria_id','stock','imagen','activo'];
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

}
