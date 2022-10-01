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
}
