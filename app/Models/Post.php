<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Validation\Rules\Exists;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'title',
        'descriptions',
        'attachments',
    ];

    public function checkLikeByUser(){ //check if user already like

        $userId = auth()->user()->id;

        $like = Like::whereUserId($userId)->wherePostId($this->id)->first();

        return $like;

    }
    public function checkUserFollowStatus(){ //check user follow status on other user

        $profile = $this->getProfilePost($this->user_id);

        $profile_id = $profile->id;

        $follow = Follow::whereFollowerId(auth()->user()->id)->whereFollowingId($profile_id)->count();

        return $follow;
    }
    public function checkUserAuthPost(){ //check post if posted by auth user

        $userId = auth()->user()->id;

        $post = Post::whereUserId($userId)->whereId($this->id)->first();

        return $post;
    }
    public function getUserPost(){ //get user data of post user

        $user = User::whereId($this->user_id)->first();

        return $user;
    }
    public function getProfilePost(){ //get profile of the poser

        $profile = Profile::whereUserId($this->user_id)->first();

        return $profile;
    }
    public function calculateLike(){ //calculate totla like

        $count = Like::wherePostId($this->id)->count();

        return $count;

    }
    public function user () {
        return $this->belongsTo(User::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }
    public function CheckUserBlock(){

        $block = Block::where('blocked_id', $this->user_id)->where('user_id', auth()->user()->id)->first();

        return $block;
    }
    public function getCommentsCount () {
        return Comment::whereModelType('\\App\\Models\\Post')->whereModelId($this->id)->count();
    }
    public function meetups(){
        return $this->hasMany(Meetup::class);
    }
    public function getPublicImage() {
        if (! $this->attachments) return '';
        $arr = explode('/', $this->attachments);
        return "/storage/" . $arr[1];
    }
}
