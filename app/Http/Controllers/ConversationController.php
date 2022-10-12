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

        return view('message.index', compact('data'));

    }
    public function conversations(Request $request){

        $id_auth = auth()->user()->id;

        $convo = Conversation::where('name', 'like', '%' . $id_auth . '%')->orderBy('updated_at', 'DESC')->get();

        return view('message.convo', compact('convo'));
    }
}
