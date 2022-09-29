<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Block as BlockModel;
use Livewire\Component;

class Block extends Component
{
    public $user_block;

    public $user_create;

    public $block;

    public $user_id_back;

    public function mount () {

        $this->user_block = User::find($this->user_block);


        $this->block = BlockModel::all();

        // $this->block = BlockModel::whereId(3)->first()->delete();
    }
    public function isBlock() {

        return auth()->user()->blocks()->where('blocked_id', $this->user_block->id)->exists();

    }
    public function block () {
        if ($this->isBlock()) {
         
            auth()->user()->blocks()->whereBlockedId($this->user_block->id)->first()->delete();

            $this->status = "unblock";

            $this->user_id_back = $this->user_block->id;
        } else {

            //create block record
      
            auth()->user()->blocks()->create(
                [
                    'blocked_id' => $this->user_block->id,
                ]
            );
            $this->status = "done";

            $this->user_id_back = $this->user_block->id;
        }
    }

    public function render()
    {
        return view('livewire.block');
    }
}
