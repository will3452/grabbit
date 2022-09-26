<?php

namespace App\Http\Livewire;

use App\Models\Conversation;
use App\Models\Message;
use Livewire\Component;
use GuzzleHttp\Psr7\Request;

class MessageLivewire extends Component
{

    public $read_by;

    public $created_by;

    public $conversation_id;
    

    public function render()
    {
        return view('livewire.message-livewire');

    }
}
