<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meetup extends Model
{
    use HasFactory;

    protected $fillable = [
        'requestor_id',
        'approver_id',
        'remarks',
        'post_id',
        'approved_at',
        'declined_at',
        'meetup_date'
    ];

    public function post(){

        return $this->belongsTo(Post::class);
        
    }
}