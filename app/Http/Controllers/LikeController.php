<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    private function like_data($post_id){ 

       return [
            'user_id' => auth()->user()->id,
            'post_id' => $post_id
        ];
        
    }

    private function check_auth_like($data){

        return Like::where('user_id', $data['user_id'])->where('post_id', $data['post_id'])->first();
    }

    public function store(Request $request){

        $data = $this->like_data($request->id);

        $check = $this->check_auth_like($data);

        if($check){

            return back();
        }
        else{

            Like::create($data);

            return back()->withSuccess('Like Added!');
        }
    }
    public function destroy(Request $request){

        $data = $this->like_data($request->id);

        $check = $this->check_auth_like($data);

        if($check->count()>0){

            $check->delete(); //delete

            return back()->withSuccess('Unlike');
        }
        else{

            return back();

        }
    }
}
