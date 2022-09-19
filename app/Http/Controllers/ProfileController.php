<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index (Request $request) {
        $user = auth()->user(); // get user data
        $profile = auth()->user()->profile()->first(); //get user profile data
        // $profile = Profile::where('user_id', auth()->user()->id)->first();
        return view('profile.index', compact('user', 'profile'));
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
