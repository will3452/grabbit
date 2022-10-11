<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Models\Meetup;
use App\Models\Comment;
use App\Models\Postimage;
use App\Models\Notification;
use Illuminate\Http\Request;

use function Symfony\Component\VarDumper\Dumper\esc;

class PostController extends Controller
{
    public function index (Request $request) {
        $posts = new Post;
        $data = $request->search;
        $data = null;
        $postslist = Post::latest()->get();
        $postarr = [];
        // $followarr = [];
        foreach($postslist as $item){
            if(!$item->CheckUserBlock()){
                $postarr[] = $item->id;
            }
        }
        // $followarr = $posts->getUserData();
        $postarr = $postarr;
        if($data){
            $posts = Post::where('title', 'like','%'.$data.'%')->where('status', null)->whereIn('id',$postarr)->latest()->paginate(5);
            return view('posts.index', compact('posts', 'data'));
        }else{
            $posts = Post::whereIn('id',$postarr)->where('status', null)->latest()->paginate(5);
            return view('posts.index', compact('posts', 'data'));
        }

    }
    public function edit (Request $request) {
        $post = Post::where('id', $request->post_id)->where('user_id', auth()->user()->id)->first();
        if($post){
            $postid = $post->id;
            return view('posts.edit', compact('postid'));
        }
        return redirect()->route('home');
    }
    public function show(Request $request) {
        $post = Post::where('id', $request->post)->where('status', null)->first();
        if($post){
            return view('posts.show', compact('post'));
        }else{
            abort(404);
        }
    }

    public function create(Request $request) {
        return view('posts.create');
    }
    public function destroy(Request $request){
        $data = $request->validate([
            'post_id' => ['required'],
        ]);
        $data['user_id'] = auth()->id();
        $delete = Post::where('id', $data['post_id'])->where('user_id', $data['user_id'])->first();
        if($delete){
            $delete->delete(); //delete post
            Postimage::where('post_id', $data['post_id'])->where('user_id', $data['user_id'])->delete();
            Comment::where('model_type', '\App\Models\Post')->where('model_id', $data['post_id'])->where('user_id', $data['user_id'])->delete();
            Meetup::where('post_id', $data['post_id'])->delete();
            return  response()->json(
                [
                    'status'=>200,
                    'messages'=>'delete',
                    'text'=> 'deleted',
                    'deletepost' => $data['post_id'],
                ]
            );
        }
    }
}
