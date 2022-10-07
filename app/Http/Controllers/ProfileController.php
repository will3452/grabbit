<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\Post;
use App\Models\User;
use App\Models\Profile;
use App\Models\Review;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index (Request $request) {
        $user = auth()->user(); // get user data
        $profile = auth()->user()->profile()->first(); //get user profile data
        // $profile = Profile::where('user_id', auth()->user()->id)->first();
        return view('profile.index', compact('user', 'profile'));
    }
    public function show(Request $request){
        $user = User::where('id', $request->user_id)->first();
        $profile = $user->profile()->first();
        $posts = Post::whereUserId($profile->user_id)->latest()->simplePaginate(4);
        $followersCount = Follow::whereFollowingId($request->user_id)->count();
        $postsCount = Post::whereUserId($profile->user_id)->count();
        $reviews = Review::whereUserId($request->user_id)->latest()->simplePaginate(3);
        $averageStar = Review::whereUserId($request->user_id)->average('star');
        return view('profile.show', compact('user', 'profile', 'posts', 'followersCount', 'postsCount', 'reviews', 'averageStar'));
    }
    public function update(Request $request){
        $data = $request->validate(
                [
                    'avatar' => ['mimes:jpg,png,jpeg', 'max:5000'],
                    'name' => 'required',
                    'address' => 'required',
                    'phone' => ['required', 'numeric'],
                    // 'attachment' => ['mimes:pdf,docx', 'max:5000'], // 5mb
                    'descriptions' => ['required', 'max:500'],    //validation of profile
                ]
            );

        if(request('avatar')){

            $imagepath = request('avatar')->store('images', 'public'); //store avatar to public storage
        }
        else{
            $imagepath = auth()->user()->profile->avatar;
        }

        auth()->user()->update([
            'name' => $data['name']                  //uodate user data
        ]);
        auth()->user()->profile->update([   //update user profile data
            'address' => $data['address'],
            'phone' => $data['phone'],
            'description' => $data['descriptions'],
            'avatar' => $imagepath,
        ]);
        return back()->withSuccess('Update Success!');
    }

}
