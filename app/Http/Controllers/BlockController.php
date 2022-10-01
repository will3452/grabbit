<?php

namespace App\Http\Controllers;

use App\Models\Block;
use Illuminate\Http\Request;

class BlockController extends Controller
{
    //

    public function isBlock($blocked_id) {

        return auth()->user()->blocks()->where('blocked_id', $blocked_id)->exists();

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
}
