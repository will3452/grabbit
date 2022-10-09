<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public static function boot(){

    //     parent::boot();

    //     static::created(function ($user){
    //         $user->profile()->create();
    //     });
    // }

    public function profile(){

        return $this->hasOne(Profile::class);
    }
    public function CheckUserBlock(){
            $block1 = Block::where('blocked_id', $this->id)->where('user_id', auth()->user()->id)->exists();
            $block2 = Block::where('blocked_id', auth()->user()->id)->where('user_id', $this->id)->exists();
            if($block1 || $block2){
                return true;
            }
            return false;
    }
    public function posts () {
        return $this->hasMany(Post::class);
    }

    public function notifications(){

        return $this->hasMany(Notification::class);
    }

    public function unreadNotifications() {
        return $this->notifications()->whereNull('read_at')->get();
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function blocks()
    {
        return $this->hasMany(Block::class);
    }
    public function reports(){

        return $this->morphToMany(Report::class, 'reportable');

    }
}
