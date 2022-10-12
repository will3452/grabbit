<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address',
        'phone',
        'avatar',
        'description',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function profiledocs(){
        return $this->hasMany(Profiledocs::class);
    }
}
