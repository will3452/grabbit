<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'title',
        'descriptions',
        'attachments',
    ];

    public function check_like_by_user($post_id){ //check if user already like

        $userId = auth()->user()->id;

        $like = Like::where('user_id', $userId)->where('post_id', $post_id)->first();

        return $like;

    }
    public function calculate_like($post_id){

        $count = Like::where('post_id', $post_id)->count();

        return $count;

    }
    public function user () {
        return $this->belongsTo(User::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }
}
