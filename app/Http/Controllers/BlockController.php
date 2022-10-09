<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class BlockController extends Controller
{
    //

    public function isBlock($blocked_id) {

        return auth()->user()->blocks()->where('blocked_id', $blocked_id)->exists();

    }
    public function index(Request $request){
        $auth_id = auth()->user()->id;
        $block = Block::orderBy('created_at', 'desc')->whereUserId($auth_id)->paginate(10);
        return view('block.index', compact('block'));
    }
    public function block (Request $request) {
        
        $data = $request->validate([

            'blocked_id' => ['required'],

        ]);

        $data['user_id'] = auth()->id();


        if (!$this->isBlock($data['blocked_id'])) {
            //create block record
            auth()->user()->blocks()->create(
                [
                    'blocked_id' => $data['blocked_id'],
                ]
            );
            return response()->json(
                [
                    'status'=>200,
                    'messages'=>'blocked',
                    'text' => "Blocking Successfully!",
                    'block_id' => $data['blocked_id'],
                ]
            );
        }
    }
    public function edit(Request $request){
        $user = User::whereId($request->user_id)->first();
        $profile = $user->profile()->first();
        return view('block.unblock', compact('user', 'profile'));
    }
    public function destroy(Request $request){
        $data = Validator::make($request->all(),
            [
                'blocked_id' => 'required'
            ]
        );
        if($data->fails()){
            return response()->json(
                [
                    'status'=>400,
                    'messages'=>$data->getMessageBag(),
                ]
            );
        }else{
            $blocked_id = $request->input('blocked_id');
            $user_id = auth()->user()->id;
            $find = Block::whereBlockedId($blocked_id)->whereUserId($user_id)->first();
            $find->delete();
            $link = route('profile.index').'/show/'.$blocked_id;
            return response()->json(
                [
                    'status'=>200,
                    'messages'=>'unblock',
                    'text' => "Blocking Successfully!",
                    'redirect_link' => $link
                ]
            );
        }
    }
}
