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
        <form class="card-body" method="POST" enctype="multipart/form-data" action="/profile/{{$user->id}}">
            @method('PATCH')
            @csrf
            
           <div>
                <label for="avatar">Profile Picture</label>
                <div class="form-group">
                    <input  name="avatar" type="file" class="form-control @error('avatar') is-invalid @enderror" placeholder="Profile Picture">
                </div>
                @error('avatar')
                <span class="text-danger">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
           </div>

            
           <div class="mb-2 mt-2">
                <label for="name">Full Name</label>
                <div class="form-group">
                    <input  name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{old('name',  $user->name)}}" placeholder="Name">
                </div>
                @error('name')
                <span class="text-danger">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
           </div>

           <div class="mb-2 mt-2">
                <label for="email">Email</label>
                <div class="form-group">
                    <p>{{$user->email}}</p>
                </div>
           </div>

            <div class="mb-2 mt-2">
                <label for="address">Address</label>
                <div class="form-group">
                    <input  name="address" type="text" class="form-control @error('address') is-invalid @enderror" value="{{old('address', $profile->address)}}" placeholder="Address">
                </div>
                @error('address')
                <span class="text-danger">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

           <div class="mb-2 mt-2">
                <label for="phone">Phone</label>
                <div class="form-group">
                    <input  name="phone" type="number" class="form-control @error('phone') is-invalid @enderror" value="{{old('phone', $profile->phone)}}"  placeholder="Phone">
                </div>
                @error('phone')
                <span class="text-danger">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
           </div>
           <div class="mb-2 mt-2">
                <label for="attachments">Attachment</label>
                <div class="form-group">
                    <input  name="attachments" type="file" class="form-control  @error('attachments') is-invalid @enderror" placeholder="Attachment">
                </div>
                @error('attachments')
                <span class="text-danger">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
           </div>
           <div class="mb-2 mt-2">
                <label for="descriptions">Description</label>
                <div class="form-group">
                    <textarea  name="descriptions" placeholder="Descriptions" class="form-control @error('descriptions') is-invalid @enderror" id="description" rows="3">{{old('descriptions', $profile->description)}}</textarea>
                </div>
                @error('descriptions')
                <span class="text-danger">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
           </div>

            <div class="mt-3 form-group" style="text-align:right !important;">
                <button type="submit" class="btn btn-primary">
                    Update Profile
                </button>
            </div>
        </form>
    </div>
@endsection