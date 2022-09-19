<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index (Request $request) {
        $posts = Post::latest()->take(25)->get();
        return view('posts.index', compact('posts'));
    }

    public function store (Request $request) {

        // $notification = new Notification(); // notifcation class
        // $data_notf = [
        //      'remarks' => 'remarks here 2',
        //     'redirect_link' => 'link here 2' //dummy data creating notif
        // ];
        // $notification->create_notification($data_notf); //create notif when some process

        $data = $request->validate([
            'title' => ['required', 'max:50'],
            'descriptions' => ['required', 'max:500'],
            'attachments' => ['image', 'max:5000'], // 5mb
        ]);

        $data['attachments'] = json_encode($request->attachments->store('public')); // wip multiple image

        // auth()->user()->post()->create($data);
        $data['user_id'] = auth()->id();
        Post::create($data);
        
        return back()->withSuccess('Post added!');
    }
}
