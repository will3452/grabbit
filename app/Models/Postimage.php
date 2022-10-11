<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postimage extends Model
{
    use HasFactory;
    protected $fillable = [
        'post_id',
        'user_id',
        'image'
    ];
    public function posts(){
        $this->belongsTo(Post::class);
    }
}
