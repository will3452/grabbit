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
        if($sort == 'post'){
            $datas = Post::where('title', 'like','%'.$search.'%')->orderBy('id', 'DESC')->get();
        }
        elseif($sort == 'profile'){
            $datas = User::where('name', 'like','%'.$search.'%')->orderBy('id', 'DESC')->get();
        }
        else{
            $datas = Post::where('title', 'like', '%'.$search.'%')->orderBy('id', 'DESC')->get();
        }
        return view('search.index', compact('datas'));
    }
}
