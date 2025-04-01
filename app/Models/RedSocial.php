<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RedSocial extends Model
{
    protected $table = "redes_sociales";
    protected $fillable = ['nombre_usuario','tipo_red_social'];
    public function veterinaria() {
        return $this->belongsTo(Veterinaria::class, 'id_veterinaria');
    }
}
