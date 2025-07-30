<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoryMedia extends Model
{
    use HasFactory;

    protected $fillable = ['historia_id', 'file_path', 'file_type', 'caption', 'order'];

    public function historia()
    {
        return $this->belongsTo(Story::class);
    }
}
