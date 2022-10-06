<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use App\Models\Notification;

class Like extends Component
{
    public $post;
    public $likes;
    public function mount (Post $post) {
        $this->post = $post;
        $this->likes = $post->likes()->count();
    }

    public function isLiked() {
        return $this->post->likes()->whereUserId(auth()->id())->exists();
    }

    public function toggle () {
        if ($this->isLiked()) {
            $this->likes --;

            // delete likes instance
            $this->post->likes()->whereUserId(auth()->id())->first()->delete();
        } else {
            $this->likes ++;

            //create likes record
            $this->post->likes()->create(['user_id' => auth()->id()]);

            if ($this->post->user_id != auth()->id()) { // send notif if others like your post
                Notification::create([
                    'user_id' => $this->post->user_id,
                    'remarks' => auth()->user()->name. " liked your post!",
                    'redirect_link' => route('post.show', ['post' => $this->post->id]),
                ]);
            }
        }
    }

    public function render()
    {
        return view('livewire.like');
    }
}
