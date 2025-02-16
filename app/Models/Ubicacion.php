<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    use HasFactory;
    protected $table = 'ubicaciones';

    public function veterinaria(){
        //Una ubicaion pertenece a una veterinaria (1)
        return $this->belongsTo(Veterinaria::class);
    }
}
