<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Historia extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'media_path', 'media_type', 'expires_at'];

    public function user()
    {
         return $this->belongsTo(User::class);
    }

    public function isActive()
    {
        return now()->lt($this->expires_at);
    }

}
