<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chatimage extends Model
{
    use HasFactory;
    protected $fillable = [
        'message_id',
        'user_id',
        'image'
    ];
    public function messages(){
        $this->belongsTo(Message::class);
    }
}
