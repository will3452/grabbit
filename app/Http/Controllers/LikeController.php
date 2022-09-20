<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store(Request $request){

        $data = auth()->user()->likes()->where('post_id', $request->input('likeinput'))->first();

        if($data){

            $data->delete();

            return response()->json(
                [
                    'status'=>200,
                    'messages'=> 'unlike',
                    'id_back' => $request->input('likeinput')
                ]
            );
        }
        else{
            
            auth()->user()->likes()->create([
                'post_id' => $request->input('likeinput')
            ]);

            return response()->json(
                [
                    'status'=>200,
                    'messages'=> 'like',
                    'id_back' => $request->input('likeinput')
                ]
            );
        }

    }
}
