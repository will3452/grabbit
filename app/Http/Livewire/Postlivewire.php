<?php

namespace App\Http\Livewire;

use App\Models\Follow;
use App\Models\Notification;
use App\Models\Post;
use App\Models\Postimage;
use Livewire\Component;
use Illuminate\Http\Request;
use Livewire\WithFileUploads;

class PostLivewire extends Component
{
    use WithFileUploads;

    public $title;
    public $descriptions;
    public $images;

    // public $attachments = '';

    public function updated($fields)
    {
        $this->validateOnly($fields,
            [
                'title' => ['required', 'max:50'],
                'descriptions' => ['required', 'max:500'],
                'images' => ['required'], // 5mb
            ],
            [
                'title.required' => 'Title Post Is Require!',
                'descriptions.required' => 'Description Post Is Require!',
                'images.required' => 'Post Image Is Require!',
            ]
        );
    }

    public function stored(Request $request)
        {
            $data = $this->validate(
                [
                    'title' => ['required', 'max:50'],
                    'descriptions' => ['required', 'max:500'],
                    'images' => ['required'], // 5mb
                ],
                [
                    'title.required' => 'Title Post Is Require!',
                    'descriptions.required' => 'Description Post Is Require!',
                    'images.required' => 'Post Image Is Require!',
                ]
            );

            // $data['attachments'] = $data['attachments']->store('public'); // wip multiple image

            $data['user_id'] = auth()->id();
            $this->create_post = Post::create($data);

            foreach ($this->images as $image) {
                $filepath = $image->store('public');
                Postimage::create([
                    'post_id' => $this->create_post->id,
                    'user_id' => auth()->user()->id,
                    'image' => $filepath,
                ]);
            }
            // // notify all followers
            $followers = Follow::whereFollowingId(auth()->id())->get()->pluck('follower_id')->all();

            foreach ($followers as $follower) {
                Notification::create([
                    'user_id' => $follower,
                    'remarks' => auth()->user()->name . ' has new post!',
                    'redirect_link' => route('post.show', ['post' => $this->create_post->id]),
                ]);
            }
            return redirect()->route('post.index')->with('success', 'Post added!');
        }
    public function render()
    {
        return view('livewire.post-livewire');
    }
}
