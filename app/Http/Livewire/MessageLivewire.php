<?php

namespace App\Http\Livewire;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Livewire\Component;
use GuzzleHttp\Psr7\Request;

class MessageLivewire extends Component
{

    public $read_by;

    public $created_by;

    public $conversation_id;

    public $message_sent;

    public $status;

    public $AllMessages;

    public function mount(){

        $this->user = User::find($this->read_by);

        $this->profile_reader = $this->user->profile()->first();
        
        if($this->isConvoExist()){

            $this->conversation_id = $this->isConvoExist()->id;

            $this->AllMessages = Message::where('conversation_id', $this->conversation_id)->get();

        }
    }

    public function checkMessages(){

        return Message::where([['created_by', $this->created_by], ['read_by', $this->read_by]])
        ->orWhere([['created_by', $this->read_by], ['read_by', $this->created_by]])->first();
    }

    public function isConvoExist(){

        if($this->checkMessages()){

            return Conversation::find($this->checkMessages()->conversation_id);
        }
    }

    public function getAllMessages(){

        if($this->isConvoExist()){

            $this->conversation_id = $this->isConvoExist()->id;

            $this->AllMessages = Message::where('conversation_id', $this->conversation_id)->get();

            $this->dispatchBrowserEvent('scrollDown');

        }

    }

    public function sendmessage(){

        $data = $this->validate(
            [
                'message_sent' => 'required',
            ]
        );

        if($this->isConvoExist()){

            //send a message

            Message::create([
                'conversation_id' => $this->isConvoExist()->id,
                'messages' => $data['message_sent'],
                'read_by' => $this->read_by,
                'created_by' => auth()->user()->id,
            ]);

            $this->message_sent = "";

            $this->getAllMessages();

            $this->dispatchBrowserEvent('scrollDown');

            $this->conversation_id = $this->isConvoExist()->id;
            
        }else{

            //send and create convo message
           $this->create_convo = Conversation::create([
                'name' => $this->created_by.'_'.$this->read_by,
           ]);
           $this->conversation_id = $this->create_convo->id;

            Message::create([
                'conversation_id' =>  $this->conversation_id,
                'messages' => $data['message_sent'],
                'read_by' => $this->read_by,
                'created_by' => auth()->user()->id,
            ]);

            $this->getAllMessages();

            $this->dispatchBrowserEvent('scrollDown');

            $this->message_sent = "";

        }
    }

    public function render()
    {
        return view('livewire.message-livewire');

    }
}
