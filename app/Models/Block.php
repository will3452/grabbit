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
    public function getUser(){ //get user data of post user

        $user = User::whereId($this->blocked_id)->first();

        return $user;
    }
    public function getProfile(){ //get profile of the poser

        $profile = Profile::whereUserId($this->blocked_id)->first();

        return $profile;
    }
    public function user(){

        return $this->belongsTo(User::class);
        
    }
}
