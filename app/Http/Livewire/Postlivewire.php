<?php

namespace App\Http\Livewire;

use App\Models\Follow;
use App\Models\Notification;
use App\Models\Post;
use Livewire\Component;
use Illuminate\Http\Request;
use Livewire\WithFileUploads;

class PostLivewire extends Component
{
    use WithFileUploads;

    public $title;
    public $descriptions;
    public $attachments;

    // public $attachments = '';

    public function updated($fields)
    {
        $this->validateOnly($fields,
            [
                'title' => ['required', 'max:50'],
                'descriptions' => ['required', 'max:500'],
                'attachments' => ['image', 'max:5000'], // 5mb
            ],
            [
                'title.required' => 'Title Post Is Require!',
                'descriptions.required' => 'Description Post Is Require!',
                'attachments.required' => 'Post Image Is Require!',
            ]
        );
    }

    public function stored(Request $request)
    {
        $data = $this->validate(
            [
                'title' => ['required', 'max:50'],
                'descriptions' => ['required', 'max:500'],
                'attachments' => ['image', 'max:5000'], // 5mb
            ],
            [
                'title.required' => 'Title Post Is Require!',
                'descriptions.required' => 'Description Post Is Require!',
                'attachments.required' => 'Post Image Is Require!',
            ]
        );

        $data['attachments'] = $data['attachments']->store('public'); // wip multiple image

        $data['user_id'] = auth()->id();
        $post = Post::create($data);

        // notify all followers
        $followers = Follow::whereFollowingId(auth()->id())->get()->pluck('follower_id')->all();

        foreach ($followers as $follower) {
            Notification::create([
                'user_id' => $follower,
                'remarks' => auth()->user()->name . ' has new post!',
                'redirect_link' => route('post.show', ['post' => $post->id]),
            ]);
        }

        return redirect()->route('post.index')->with('success', 'Post added!');


    }
    public function render()
    {
        return view('livewire.post-livewire');
    }
}
