@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb :links="[
        [
            'label' => 'Home',
            'link' => '/home',
            'active' => false,
        ],
        [
            'label' => 'Profile',
            'link' => '/profile',
            'active' => true
        ]
    ]"/>
@endsection
@section('content')
<div class="card">
    <div class="card-header">Profile</div>
    <div class="d-flex justify-content-center p-3">
        @if ($profile->avatar)
            <img class="rounded-circle img-thumbnail object-fit-cover profile-avatar-size"src="{{ asset('storage/'.$profile->avatar) }}" alt="">
        @else
            <div class="no-profile-image">
                No Profile image
            </div>
        @endif

    </div>
    <div class="card-body"">
       <div class="mb-2 mt-2">
            <label for="name">Full Name</label>
            <div class="form-group">
                <input type="text" value="{{$user->name}}" disabled  class="form-control">
            </div>
       </div>

       <div class="mb-2 mt-2">
            <label for="email">Email</label>
            <div class="form-group">
                <input type="text" value="{{$user->email}}" disabled  class="form-control">
            </div>
       </div>

        <div class="mb-2 mt-2">
            <label for="address">Address</label>
            <div class="form-group">
                <input type="text" value="{{$user->address}}" disabled  class="form-control">
            </div>
        </div>
       <div class="mb-2 mt-2">
            <label for="phone">Phone</label>
            <div class="form-group">
                <input type="text" value="{{$user->phone}}" disabled  class="form-control">
            </div>
       </div>
       <div class="mb-2 mt-2">
            <label for="descriptions">Description</label>
            <div class="form-group">
                <textarea disabled class="form-control" id="description" rows="3">{{$profile->description}}</textarea>
            </div>
       </div>
    </div>
</div>
@endsection