<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index (Request $request) {
        $posts = Post::latest()->take(25)->get();
        return view('posts.index', compact('posts'));
    }

    public function store (Request $request) {
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
