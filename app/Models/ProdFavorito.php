<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prod_favorito extends Model
{
    use SoftDeletes, HasFactory;

    public function user()
    {
        $this->belongsTo(User::class);
    }
    public function producto()
    {
        $this->belongsTo(Producto::class);
    }

}
