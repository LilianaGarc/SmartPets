<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Notificacion extends Model
{
    use HasFactory;
    protected $table = 'notificaciones';
    protected $fillable = ['user_id', 'mensaje', 'visto', 'data'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
