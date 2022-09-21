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

    public function check_like_by_user(){ //check if user already like

        $userId = auth()->user()->id;

        $like = Like::where('user_id', $userId)->where('post_id', $this->id)->first();

        return $like;

    }
    public function calculate_like(){

        $count = Like::where('post_id', $this->id)->count();

        return $count;

    }
    public function user () {
        return $this->belongsTo(User::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    public function getCommentsCount () {
        return Comment::whereModelType('\\App\\Models\\Post')->whereModelId($this->id)->count();
    }
}
