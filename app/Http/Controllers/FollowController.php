<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Follow;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    //
    public function store(Request $request){

        $follow = new Follow;

        $data = $request->validate([
            'following_id' => ['required'],
        ]);
        
        $data['follower_id'] = auth()->id();

        $check = $follow->whereFollowerId($data['follower_id'])->whereFollowingId($data['following_id'])->first();

        if($check){

            $check->delete();

            return response()->json(
                [
                    'status'=>200,
                    'messages'=>'Unfollow',
                    'unfollowed_id' => $data['following_id'],
                ]
            );
        }else{
            $follow->create($data);

            return response()->json(
                [
                    'status'=>200,
                    'messages'=>'Follow',
                    'followed_id' => $data['following_id'],
                ]
            );
        }
     
    }
}
