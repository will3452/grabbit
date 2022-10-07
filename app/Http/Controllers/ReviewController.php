<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request){


        $data = $request->validate([
            'remarks' => ['required'],
            'star' => ['required'],
            'user_id' => ['required']
        ]);
        $data['reviewer_id'] = auth()->id();
        $data['user_id'] = intval($data['user_id']);

        Review::create($data);

        toast('Review has been submitted!');
        return back();
    }
}
