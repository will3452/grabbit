<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request){
        $sort = $request->sort;
        $search = $request->search;
        $postslist = Post::latest()->get();
        $postarr = [];
        foreach($postslist as $item){
            if(!$item->CheckUserBlock()){
                $postarr[] = $item->id;
            }
        }
        $postarr = $postarr; //post sort not block user

        $userlist = User::latest()->get();
        $userarr = [];
        foreach($userlist as $item){
            if(!$item->CheckUserBlock()){
                $userarr[] = $item->id;
            }
        }
        $userarr = $userarr; //post sort not block user
        if($sort == 'post'){
            $datas = Post::where('title', 'like','%'.$search.'%')->whereIn('id',$postarr)->orderBy('id', 'DESC')->get();
        }
        elseif($sort == 'profile'){
            $datas = User::where('name', 'like','%'.$search.'%')->whereIn('id',$userarr)->orderBy('id', 'DESC')->get();
        }
        else{
            $datas = Post::where('title', 'like', '%'.$search.'%')->whereIn('id',$postarr)->orderBy('id', 'DESC')->get();
        }
        return view('search.index', compact('datas'));
    }
}
