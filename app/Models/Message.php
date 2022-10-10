<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'conversation_id',
        'messages',
        'read_by',
        'created_by',
    ];


    public function conversations(){
        
        $this->belongsTo(Conversation::class);
    }
    public function getFiles(){
        $get = Chatimage::where('message_id', $this->id)->get();
        return $get;
    }
    public function getPublicImage($image) {
        if (! $image) return '';
        $arr = explode('/', $image);
        return "/storage/" . $arr[1];
        // return $extension = pathinfo($image, PATHINFO_EXTENSION);
    }
    public function images()
    {
        return $this->hasMany(Chatimage::class);
    }
}
