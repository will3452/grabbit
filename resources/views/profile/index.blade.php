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
                <img class="rounded-circle img-thumbnail object-fit-cover profile-avatar-size"src="{{ asset('storage/'.$profile->avatar) }}" alt="">
        </div>
        <form class="submitprofile card-body" method="POST" enctype="multipart/form-data">
            @csrf
           <div>
                <label for="avatar">Profile Picture</label>
                <div class="form-group">
                    <input  name="avatar" type="file" class="form-control" placeholder="Profile Picture">
                </div>
                <span class="text-danger">
                    <strong class="avatar-img"></strong>
                </span>
           </div>
           <div class="mb-2">
                <label for="name">Full Name</label>
                <div class="form-group">
                    <input  name="name" id="name" type="text" class="form-control" value="{{old('name',  $user->name)}}" placeholder="Name">
                </div>
                <span class="text-danger">
                    <strong  class="name"></strong>
                </span>
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
                    <input  name="address" id="address" type="text" class="form-control" value="{{old('address', $profile->address)}}" placeholder="Address">
                </div>
                <span class="text-danger">
                    <strong class="address"></strong>
                </span>
            </div>

           <div class="mb-2 mt-2">
                <label for="phone">Contact number</label>
                <div class="form-group">
                    <input  name="phone" id="phone" type="number" class="form-control" value="{{old('phone', $profile->phone)}}"  placeholder="Phone">
                </div>
                <span class="text-danger">
                    <strong class="phone"></strong>
                </span>
           </div>
           <div class="mb-2 mt-2">
                <label for="attachments">Certificates /Logo / Pictures </label>
                <div class="form-group">
                    <input  name="attachments[]" id="attachments" type="file" class="form-control"  @error('attachments.*') is-invalid @enderror" multiple placeholder="Attachment">
                </div>
                <span class="text-danger">
                    <strong class="attachments"></strong>
                </span>
           </div>
           <div class="mb-2 mt-2">
                <label for="descriptions">Additional Information</label>
                <div class="form-group">
                    <textarea  name="descriptions" placeholder="Descriptions" class="form-control" rows="3">{{old('descriptions', $profile->description)}}</textarea>
                </div>
                <span class="text-danger">
                    <strong class="descriptions"></strong>
                </span>
           </div>

            <div class="mt-3 form-group" style="text-align:right !important;">
                <button type="submit" id="updatebtmprofile" class="btn btn-primary">
                    Update Profile
                </button>
            </div>
        </form>
    </div>
    <script src="{{ asset('js/profile.js') }}"></script>
@endsection