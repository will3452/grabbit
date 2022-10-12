<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profiledocs extends Model
{
    use HasFactory;
    protected $fillable = [
        'profile_id',
        'image',
    ];
    public function profile(){
        return $this->belongsTo(profile::class);
    }
}
