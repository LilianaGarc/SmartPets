<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Testing\Fluent\Concerns\Has;
use Monolog\Handler\FormattableHandlerTrait;

class Participacion extends Model
{
    use HasFactory;
    protected $table = 'participaciones';
    
    protected $fillable = [
        'id_user',
        'evento_id',
    ];

    public function user()
    {
        // Una participación pertenece a un usuario (1)
        return $this->belongsTo(User::class, 'id_user');
    }
    public function evento()
    {
        // Una participación pertenece a un evento (1)
        return $this->belongsTo(Evento::class, 'evento_id');
    }
}
