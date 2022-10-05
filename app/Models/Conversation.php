<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public $index;

    public function explodeConvo(){

        $idex = explode('_', $this->name);
        
        if($idex[0] == auth()->user()->id){

            $this->index = $idex[1];
        }
        else{

            $this->index = $idex[0];

        }

    }
    public function geUserConvo(){ 

        $this->explodeConvo();

        $user = User::whereId($this->index)->first();

        return $user;
    }
    public function getProfileConvo(){ 

        $this->explodeConvo();

        $profile = Profile::whereUserId($this->index)->first();

        return $profile;
    }

    public function messages(){

        $this->hasMany(Message::class);
    }
}
