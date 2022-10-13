<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use App\Models\Availability;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;
use Illuminate\Support\Facades\Validator;

class AvailabilityController extends Controller
{
    public function create(Request $request){
        return view('availability.create');
    }
}
