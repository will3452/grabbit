<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Post;
use App\Models\Like;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index (Request $request) {

        $data = $request->search;

        if($data){
            $posts = Post::where('title', 'like','%'.$data.'%')->latest()->paginate(5);
            return view('posts.index', compact('posts', 'data'));
        }else{
            $data = null;
            $posts = Post::latest()->paginate(5);
            return view('posts.index', compact('posts', 'data'));

        }

    }

    public function show(Request $request, Post $post) {
        return view('posts.show', compact('post'));
    }

    public function create(Request $request) {
        return view('posts.create');
    }
}
