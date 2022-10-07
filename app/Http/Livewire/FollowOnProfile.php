<?php

namespace App\Http\Livewire;

use App\Models\Follow;
use App\Models\Notification;
use App\Models\User;
use Livewire\Component;

class FollowOnProfile extends Component
{
    public function render()
    {
        return view('livewire.follow-on-profile');
    }

    public $isFollowed;
    public $user;

    public function mount(User $user) {
        $this->user = $user;
        $this->isFollowed = Follow::whereFollowerId(auth()->id())->whereFollowingId($user->id)->exists();
    }

    public function toggleFollow() {
        if (! $this->isFollowed) {
            Follow::create(['follower_id' => auth()->id(), 'following_id' => $this->user->id]);
            Notification::create([
                'user_id' => $this->user->id,
                'remarks' => auth()->user()->name . ' visited your profile and followed you!',
                'redirect_link' => '#',
            ]);
        } else {
            Follow::whereFollowerId(auth()->id())->whereFollowingId($this->user->id)->delete();
        }

        $this->isFollowed = ! $this->isFollowed;
    }
}
