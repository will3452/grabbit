<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;

    protected $fillable = [
        'blocked_id',
        'blocker_id'
    ];

    public function user(){

        return $this->belongsTo(User::class);
        
    }
}
