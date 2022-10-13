<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use App\Models\Availability;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;
use Illuminate\Support\Facades\Validator;

class AvailabilityController extends Controller
{
    
    public function create(Request $request){
        return view('availability.create');
    }
    public function store(Request $request){
        date_default_timezone_set('Asia/Manila');
        $datetoday = date('Y-m-d');
        //          return  response()->json(
        //             [
        //                 'status'=> 200,
        //                 'messages'=> date('H:i', time()),
        //                 'time' => request('endtime'),
        //                 'message2' => date('Y-m-d'),
        //                 'date' => request('date'),
        //                 'start' => request('starttime'),
        //             ]
        //         );
        $data = Validator::make($request->all(),
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
        if($data->fails()){
            return  response()->json(
                [
                    'status'=> 400,
                    'messages'=>$data->getMessageBag(),
                ]
            );
        }else{
            //check if time 
            if(request('endtime') < request('starttime')){
                return  response()->json(
                    [
                        'status'=> 204,
                        'messages'=> 'Please Validate Start Time And End Time Input',
                    ]
                );
            }else{
               if(request('date')<=$datetoday){
                    return  response()->json(
                        [
                            'status'=> 205,
                            'messages'=> 'Please Input Future Date',
                        ]
                    );
               }else{
                    $check = Availability::where('user_id', auth()->user()->id)->where('date', request('date'))->exists();
                    if($check){
                        return  response()->json(
                            [
                                'status'=> 206,
                                'messages'=>'Date Already Exist',
                            ]
                        );
                    }else{
                        Availability::create([
                            'user_id'=>auth()->user()->id,
                            'date'  => request('date'),
                            'start_time' => request('starttime'),
                            'end_time' => request('endtime')
                        ]);
                        return  response()->json(
                            [
                                'status'=> 200,
                                'messages'=>'success',
                                'location' => '/profile/show/'.auth()->user()->profile->id,
                            ]
                        );
                    }
               }
            }
           
        }
    }
}
