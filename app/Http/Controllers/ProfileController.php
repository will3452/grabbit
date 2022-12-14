<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use App\Models\Follow;
use App\Models\Review;
use App\Models\Profile;
use App\Models\Profiledocs;
use Illuminate\Http\Request;
use App\Models\Availability;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

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
        $reviews = Review::whereUserId($request->user_id)->latest()->get();
        $averageStar = Review::whereUserId($request->user_id)->average('star');

        if(auth()->user()->id == $request->user_id){
            $posts = Post::whereUserId($profile->user_id)->latest()->simplePaginate(6);
            $postsCount = Post::whereUserId($profile->user_id)->count();
        }else{
            $posts = Post::whereUserId($profile->user_id)->where('status', null)->latest()->simplePaginate(6);
            $postsCount = Post::whereUserId($profile->user_id)->where('status', null)->count();
        }
        $availabledate = Availability::where('date', '>' ,Carbon::now()->format('Y-m-d'))->where('user_id', $request->user_id)->orderBy('created_at', 'desc')->get();
        if($user->CheckUserBlock()){
            return redirect()->route('home');
        }
        return view('profile.show', compact('user', 'profile', 'posts', 'followersCount', 'postsCount', 'reviews', 'averageStar', 'availabledate'));
    }
    public function update(Request $request){
        $data = Validator::make($request->all(),
            [
                'avatar' => ['mimes:jpg,png,jpeg', 'max:5000'],
                'name' => 'required',
                'address' => 'required',
                'document' =>  ['mimes:pdf,docx'],
                'phone' => ['required', 'numeric'],
                'descriptions' => ['required', 'max:500'],    //validation of profile
            ]
        );
        if($data->fails()){
            return  response()->json(
                [
                    'status'=> 400,
                    'messages'=>$data->getMessageBag(),
                ]
            );
        }
        else{
            if(request('avatar')){
                $imagepath = request('avatar')->store('images', 'public'); //store avatar to public storage
            }else{
                $imagepath = auth()->user()->profile->avatar;
            }
            if(request('document')){
                $docspath = request('document')->store('public'); //store documets to public storage
            }else{
                $docspath = auth()->user()->profile->document;
            }
            
            auth()->user()->update([
                'name' => request('name')                  //uodate user data
            ]);
            auth()->user()->profile->update([   //update user profile data
                'address' => request('address'),
                'phone' =>  request('phone'),
                'description' => request('descriptions'),
                'document' => $docspath,
                'avatar' => $imagepath,
            ]);
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
