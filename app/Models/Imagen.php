<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    protected $table = "imagenes";
    protected $fillable = ['path'];
    public function veterinaria() {
        return $this->belongsTo(Veterinaria::class, 'id_veterinaria');
    }
}
