<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    //
    public function index(Request $request){
        $notif = auth()->user()->notification()->latest()->get();// get all notif of auth user
        return view('notification.index');
    }
    public function show(Request $request, $data){
        $notif_data = auth()->user()->notification()->where('id', $data)->first(); // find notification for specific auth user
        return view('notification.show', compact($notif_data)); //return data in view
    }
    public function store(Request $request){
        $data = [
            'remarks' => 'remarks here 2',
            'redirect_link' => 'link here 2' //dummy acc for creating notif
        ];
        $data['user_id'] = auth()->id(); //the id of auth user
        auth()->user()->notification()->create($data); //creating notifincation for auth user
        return 'success';
    }

    public function destroy(Request $request, $data){
       auth()->user()->notification()->where('id', $data)->delete(); //deleting notif for auth user
       return back()->withSuccess('Delete Notification Successful'); 
    }
}
