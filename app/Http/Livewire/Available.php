<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Availability;
use Illuminate\Support\Carbon;

class Available extends Component
{
    public $date;
    public $starttime;
    public $endtime;
    public function stored(){
            $data = $this->validate(
                [
                    'date' => 'required|date_format:Y-m-d',
                    'starttime' => 'required|date_format:H:i',
                    'endtime' => 'required|date_format:H:i',
                ],
                [
                    'date.required'=> 'Please Input Date',
                    'starttime.required'=> 'Please Input Start Time',
                    'endtime.required'=> 'Please Input End Time',
                    'date.date_format'=> 'Please Input Validate Date',
                    'starttime.date_format'=> 'Please Input Valid Start Time',
                    'endtime.date_format'=> 'Please Input Valid End Time',
                ]
            );
            if($this->endtime < $this->starttime){
                $this->addError('starttime', 'Please Validate Start Time And End Time Input');
            }else{
                if($this->date <=  Carbon::now()->format('Y-m-d')){
                    $this->addError('date', 'Please Input Future Date');
                }else{
                    $check = Availability::where('user_id', auth()->user()->id)->where('date', $this->date)->exists();
                    if($check){
                        $this->addError('date', 'Date Already Exist');
                    }
                    else{
                        Availability::create([
                            'user_id'=>auth()->user()->id,
                            'date'  => $this->date,
                            'start_time' => $this->starttime,
                            'end_time' => $this->endtime
                        ]);
                        return redirect('/profile/show/'.auth()->user()->profile->id)->with('success', 'Date Available Added');
                    }
                }
            }
    }
    public function render()
    {
        return view('livewire.available');
    }
}
