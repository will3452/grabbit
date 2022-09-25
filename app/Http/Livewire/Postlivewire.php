<?php

namespace App\Http\Livewire;

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
        Post::create($data);

        return redirect()->route('post.index');


    }

    public function render()
    {
        return view('livewire.post');
    }
}