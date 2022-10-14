<?php

namespace App\Http\Livewire;
use App\Models\Post;
use Livewire\Component;
use App\Models\Availability;
use App\Models\Notification;
use Illuminate\Support\Carbon;
use App\Models\Meetup as MeetupClass;

class Meetup extends Component
{
    public $postid;
    public $meetup_date;
    public $getData;
    public $datelists = [];
    public $time;
    public $titleoftime;
    public $remarks;
    public $status;
    public function mount(){ //stop here
        $this->postid = Post::where('id', $this->postid)->first();
        $this->dateget = Availability::where('user_id', $this->postid->user_id)->where('date', '>' ,Carbon::now()->format('Y-m-d'))->get();
        foreach($this->dateget as $item){
            $this->datelists[] = $item->date;
        }
    }
    public function updated(){
        $this->titleoftime = "List Of Time";
        $this->getData = Availability::where('user_id', $this->postid->user_id)->where('date', $this->meetup_date)->first();
    }
    public function stored(){
        $data = $this->validate(
            [
                'meetup_date' => 'required|date_format:Y-m-d',
                'time' => 'required|date_format:H:i',
            ],
            [
                'meetup_date.required'=> 'Please Input Date',
                'time.required'=> 'Please Input Time',
                'meetup_date.date_format'=> 'Please Input Validate Date',
                'time.date_format'=> 'Please Input Valid Time',
            ]
        );
        if($this->meetup_date <=  Carbon::now()->format('Y-m-d')){
            $this->addError('meetup_date', 'Please Input Future Date');
        }else{
            $check = Availability::where('user_id', $this->postid->user_id)->where('date', $this->meetup_date)->exists();
            if(!$check){
                $this->addError('meetup_date', 'Date Not Exist');
            }else{
                $check = MeetupClass::whereRequestorId(auth()->user()->id)->whereApproverId($this->postid->user_id)->wherePostId($this->postid->id)->first();
                if($check){
                    $this->addError('meetup_date', 'You Already Set Meeting Up On this Post');
                }else{
                    MeetupClass::create([
                        'requestor_id'=>auth()->user()->id,
                        'approver_id'=> $this->postid->user_id,
                        'remarks' => $this->remarks,
                        'post_id' => $this->postid->id,
                        'tset'=> $this->time,
                        'meetup_date'=> $this->meetup_date,
                    ]);
                    Notification::create([
                        'user_id' => $this->postid->user_id,
                        'remarks' => auth()->user()->name. ' sent a meetup request to you.',
                        'redirect_link' => route('meetup.showrequestmeetuplist'),
                    ]);
                    return redirect()->route('meetup.showrequestedmeetuplist')->with('success', 'Meetup Added!');
                }
            }
        }
    }
    public function render()
    {
        return view('livewire.meetup');
    }
}
