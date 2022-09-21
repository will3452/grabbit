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
        $notif_data = auth()->user()->notification()->whereId($data)->first(); // find notification for specific auth user
        // return view('notification.show', compact($notif_data)); //return data in view
        dd($notif_data);
    }
}
