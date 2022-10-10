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
        $data = null;
        $postslist = Post::latest()->get();
        $postarr = [];
        foreach($postslist as $item){
            if(!$item->CheckUserBlock()){
                $postarr[] = $item->id;
            }
        }
        $postarr = $postarr;
        if($data){
            $posts = Post::where('title', 'like','%'.$data.'%')->whereIn('id',$postarr)->latest()->paginate(5);
            return view('posts.index', compact('posts', 'data'));
        }else{
            $posts = Post::whereIn('id',$postarr)->latest()->paginate(5);
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
