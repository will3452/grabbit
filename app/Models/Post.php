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
        'lat',
        'lng',
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

        $block1 = Block::where('blocked_id', $this->user_id)->where('user_id', auth()->user()->id)->exists();
        $block2 = Block::where('blocked_id', auth()->user()->id)->where('user_id', $this->user_id)->exists();
        if($block1 || $block2){
            return true;
        }
        return false;
    }
    // public function getAllMyFollow(){
    //     $follow = Follow::where('follower_id', auth()->user()->id)->get();
    //     return $follow;
    // }
    // public function getProfileData(){
    //     foreach($this->getAllMyFollow() as $items){
    //         $followarr[] = $items->following_id;
    //     }
    //     $profile = Profile::wherein('id', $followarr)->get();
    //     return $profile;
    // }
    // public function getUserData(){
    //     foreach($this->getProfileData() as $item2){
    //         $userid[] = $item2->user_id;
    //     }
    //     return $userid;
    // }
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
    public function getExploadImage($image){
        $arr = explode('/', $image);
        return "/storage/" . $arr[1];
    }
    public function getPostImage(){
        $postimage = Postimage::where('post_id', $this->id)->get();
        return $postimage;
    }
    public function checkWishlist(){
        $wishlist = Wishlist::whereUserId(auth()->id())->wherePostId($this->id)->exists();
        return $wishlist;
    }
    public function reports(){

        return $this->morphToMany(Report::class, 'reported');

    }
    public function postimages(){
        return $this->hasMany(Postimage::class);
    }
}
