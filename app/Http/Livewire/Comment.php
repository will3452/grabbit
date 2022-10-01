<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\Comment as CommentModel;
use Livewire\Component;

class Comment extends Component
{
    public $post;
    public $comments;
    public $comment;
    public $viewComments;

    public function loadComments () {
        $this->comments = CommentModel::whereModelType('\\App\\Models\\Post')
                                ->whereModelId($this->post->id)
                                ->latest()
                                ->limit(10)
                                ->get();

        $this->comments->load('user');
    }

    public function mount (Post $post) {
        $this->viewComments = false;
        $this->post = $post;
        $this->comment = "";

        $this->loadComments();

    }

    public function toggleComment() {
        $this->viewComments = ! $this->viewComments;
    }

    public function addComment() {
        CommentModel::create([
            'model_type' => '\\App\\Models\\Post',
            'model_id' => $this->post->id,
            'value' => $this->comment,
            'user_id' => auth()->id(),
        ]);
        $this->comment = "";
        $this->loadComments();

    }

    public function render()
    {
        return view('livewire.comment');
    }
}
