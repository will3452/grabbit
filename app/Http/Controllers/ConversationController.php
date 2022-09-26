<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    public function index(Request $request){

        $data['read_by'] = $request->read_by;

        $data['created_by'] = auth()->id();

        $check_create_by = Message::where([['created_by', $data['created_by']], ['read_by', $data['read_by']]])
                        ->orWhere([['created_by', $data['read_by']], ['read_by', $data['created_by']]])->first();

        if($check_create_by){

            $data['conversation_id'] = $check_create_by->conversation_id;

              return view('message.index', compact('data'));

        }else{

            $data['conversation_id'] = '';

              return view('message.index', compact('data'));
        }

    }
}
