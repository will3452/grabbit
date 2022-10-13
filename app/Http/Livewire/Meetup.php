<?php

namespace App\Http\Livewire;
use Illuminate\Support\Carbon;
use App\Models\Availability;
use App\Models\Post;
use Livewire\Component;

class Meetup extends Component
{
    public $postid;
    public $meetup_date;
    public $getData;
    public $datelists = [];
    public $time;
    public function mount(){ //stop here
        $this->postid = Post::where('id', $this->postid)->first();
        $this->dateget = Availability::where('user_id', $this->postid->user_id)->where('date', '>' ,Carbon::now()->format('Y-m-d'))->get();
        foreach($this->dateget as $item){
            $this->datelists[] = $item->date;
        }
    }
    public function updated(){
        $this->getData = Availability::where('user_id', $this->postid->user_id)->where('date', $this->meetup_date)->first();
    }
    public function stored(){

    }
    public function render()
    {
        return view('livewire.meetup');
    }
}
