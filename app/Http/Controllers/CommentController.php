<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function addComment (Request $request) {
        $data = $request->validate([
            'value' => ['required', 'max:100'],
            'model_type' => ['required'],
            'model_id' => ['required'],
        ]);

        $data['user_id'] = auth()->id();

        $comments = Comment::create($data);

        return $comments;
    }

    public function removeComment (Request $request, Comment $comment) {
        return $comment->delete();
    }
}
