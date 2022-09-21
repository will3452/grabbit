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

        $like = Like::whereUserId($userId)->wherePostId($this->id)->first();

        return $like;

    }
    public function check_user_follow_status($userid){

        $follow = Follow::whereFollowerId(auth()->user()->id)->whereFollowingId($userid)->count();

        return $follow;
    }
    public function check_user_auth_post(){

        $userId = auth()->user()->id;

        $post = Post::whereUserId($userId)->whereId($this->id)->first();

        return $post;
    }
    public function get_user_post($userid){

        $user = User::whereId($userid)->first();

        return $user;
    }
    public function get_profile_post($userid){
        
        $profile = Profile::whereUserId($userid)->first();

        return $profile;
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
