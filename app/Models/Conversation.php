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
    public function CheckUserBlock($id_block){
        $block1 = Block::where('blocked_id', $id_block)->where('user_id', auth()->user()->id)->exists();
        $block2 = Block::where('blocked_id', auth()->user()->id)->where('user_id', $id_block)->exists();
        if($block1 || $block2){
            return false;
        }
        return true;
    }
    public function getLatestMessage(){
        $latest = Message::where('conversation_id', $this->id)->latest()->first();
        return $latest;
    }
    public function messages(){

        $this->hasMany(Message::class);
    }
}
