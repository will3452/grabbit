<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\Postimage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Postedit extends Component
{
    use WithFileUploads;
    public $title;
    public $postid;
    public $images = [];
    public $descriptions;
    public $postdata;
    public $imagepost;
    public $statuspost;
    public function mount(){
        $this->postdata = Post::where('id', $this->postid)->where('user_id', auth()->user()->id)->first();
        $this->title = $this->postdata->title;
        $this->statuspost = $this->postdata->status;
        $this->descriptions = $this->postdata->descriptions;
        $this->imagepost = $this->loadImages();
    }
    public function loadImages(){
        //get images of post
        return $this->postdata->getPostImage();
    }
    public function updated($fields)
    {
        $this->validateOnly($fields,
            [
                'title' => ['required', 'max:50'],
                'descriptions' => ['required', 'max:500'],
            ],
            [
                'title.required' => 'Title Post Is Require!',
                'descriptions.required' => 'Description Post Is Require!',
            ]
        );
    }
    public function deleteimage($id){
        $count = Postimage::where('post_id', $this->postid)->where('user_id', auth()->user()->id)->count();
        if($count<=1){
            $this->dispatchBrowserEvent('errormessage');
        }else{
            Postimage::where('id', $id)->where('user_id', auth()->user()->id)->delete();
            $this->imagepost = $this->loadImages();
            $this->dispatchBrowserEvent('popmessage');
        }
    
    }
    public function updatepost(){
        $data = $this->validate(
            [
                'title' => ['required', 'max:50'],
                'descriptions' => ['required', 'max:500'],
            ],
            [
                'title.required' => 'Title Post Is Require!',
                'descriptions.required' => 'Description Post Is Require!',
            ]
        );
        Post::where('id', $this->postid)->where('user_id', auth()->user()->id)
                    ->update($data);
        foreach ($this->images as $image) {
                $filepath = $image->store('public');
                Postimage::create([
                'post_id' => $this->postid,
                'user_id' => auth()->user()->id,
                'image' => $filepath,
            ]);
        }
        $this->imagepost = $this->loadImages();
        $this->dispatchBrowserEvent('updatesuccess');
    }
    public function updatestatus(){
        $data = $this->validate(
            [
                'statuspost' => ['required', 'max:50'],
            ],
            [
                'statuspost.required' => 'Mark Status Post Is Require!',
            ]
        );
        if($this->statuspost == 'sold'){
            Post::where('id', $this->postid)->where('user_id', auth()->user()->id)
                    ->update([
                        'status'=> 'Sold Out'
            ]);
            $this->statuspost = 'Sold Out';
            $this->dispatchBrowserEvent('updatesuccess');
        }elseif($this->statuspost == 'not-sold'){
            Post::where('id', $this->postid)->where('user_id', auth()->user()->id)
            ->update([
                'status'=> null
            ]);
            $this->statuspost = '';
            $this->dispatchBrowserEvent('updatesuccess');
        }
    }
    public function render()
    {
        return view('livewire.postedit');
    }
}
