<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Follow;
use App\Models\Review;
use App\Models\Profile;
use App\Models\Profiledocs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $followersCount = Follow::whereFollowingId($request->user_id)->count();
        $reviews = Review::whereUserId($request->user_id)->latest()->simplePaginate(3);
        $averageStar = Review::whereUserId($request->user_id)->average('star');

        if(auth()->user()->id == $request->user_id){
            $posts = Post::whereUserId($profile->user_id)->latest()->simplePaginate(6);
            $postsCount = Post::whereUserId($profile->user_id)->count();
        }else{
            $posts = Post::whereUserId($profile->user_id)->where('status', null)->latest()->simplePaginate(6);
            $postsCount = Post::whereUserId($profile->user_id)->where('status', null)->count();
        }
       
        if($user->CheckUserBlock()){
            return redirect()->route('home');
        }
        return view('profile.show', compact('user', 'profile', 'posts', 'followersCount', 'postsCount', 'reviews', 'averageStar'));
    }
    public function update(Request $request){
        $data = Validator::make($request->all(),
            [
                'avatar' => ['mimes:jpg,png,jpeg', 'max:5000'],
                'name' => 'required',
                'address' => 'required',
                'phone' => ['required', 'numeric'],
                'descriptions' => ['required', 'max:500'],    //validation of profile
            ]
        );
        $validateimage = Validator::make($request->all(),
            [
                'attachments.*' => ['mimes:jpg,jpeg,png', 'max:5000'], // 5mb
            ],
            [
                'attachments.*.mimes' => 'Only jpg, jpeg, png images are allowed',
            ]
        );
        if($data->fails() && $validateimage->fails()){
            return  response()->json(
                [
                    'status'=>'400-both',
                    'messages'=>$data->getMessageBag(),
                    'messageimage' => 'Only jpg, jpeg, png images are allowed'
                ]
            );
        }
        elseif($data->fails()){
            return  response()->json(
                [
                    'status'=>'404-datas',
                    'messages'=>$data->getMessageBag(),
                ]
            );
        }
        elseif($validateimage->fails()){
            return  response()->json(
                [
                    'status'=>'404-images',
                    'messageimage'=>'Only jpg, jpeg, png images are allowed',
                ]
            );
        }
        else{
            if(request('avatar')){
                $imagepath = request('avatar')->store('images', 'public'); //store avatar to public storage
            }else{
                $imagepath = auth()->user()->profile->avatar;
            }
            auth()->user()->update([
                'name' => request('name')                  //uodate user data
            ]);
            auth()->user()->profile->update([   //update user profile data
                'address' => request('address'),
                'phone' =>  request('phone'),
                'description' => request('descriptions'),
                'avatar' => $imagepath,
            ]);
           if(request('attachments')){
                foreach(request('attachments') as $attach){
                    $imageatt = $attach->store('images', 'public'); //store avatar to public storage
                    Profiledocs::create([
                        'profile_id' => auth()->user()->profile->id,
                        'image' => $imageatt,
                    ]);
                }
           }
           return  response()->json(
                [
                    'status'=>200,
                    'messages'=>'success',
                    'location' => '/profile/show/'.auth()->user()->profile->id,
                ]
            );
        }
    }

}
