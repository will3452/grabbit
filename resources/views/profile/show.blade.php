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
<div class="row">
    <div class="col-12 col-md-4">
        <div class="card ">
            <div class="card-header">
                Profile
            </div>
            <div class="card-body ">
                <div class="d-flex justify-content-center">
                    @if ($profile->avatar)
                        <img class="rounded-circle img-thumbnail object-fit-cover profile-avatar-size"src="{{ asset('storage/'.$profile->avatar) }}" alt="">
                    @else
                        <div class="no-profile-image">
                            No Profile image
                        </div>
                    @endif
                </div>
                <div>
                    <div style="font-size: 18px; text-transform: uppercase; letter-spacing: 0.25em" class="text-center">
                        {{ $profile->user->name }}
                    </div>
                    <div  class="text-center">
                        <small class="text-secondary">
                            {{$profile->user->email}} | {{$profile->phone}}
                        </small>
                    </div>
                    <div  class="text-center" >
                        <small class="text-secondary">
                            {{$profile->address}}
                        </small>
                    </div>
                    <div  class="text-center" >
                        <small class="text-secondary">
                            {{$profile->description}}
                        </small>
                    </div>
                </div>
                @if (auth()->user()->id == $user->id)
                    <div class="d-flex justify-content-center mt-2 mb-2">
                        <a href="/profile" class="btn btn-primary">Edit Profile</a>
                    </div>
                @endif
                @if (auth()->user()->id != $user->id)
                    <div class="d-flex justify-content-center">
                        <x-review-stars :value="$averageStar"></x-review-stars>
                    </div>
                    @livewire('follow-on-profile', ['user' => $profile->user_id], key($profile->user_id))
                    <div class="d-flex justify-content-center mt-2 mb-2">
                        <a href="/convo/message/{{$profile->user_id}}" class="btn btn-primary">Message</a>
                    </div>
                    <div class="mt-2 text-center">
                        <x-modal modalTitle="Write Review" modalTrigger="WRITE REVIEW">
                            <form action="{{route('review.store')}}" method="POST">
                                @csrf
                                <input type="hidden" name="user_id" value="{{$profile->user_id}}">
                                <textarea name="remarks"  required class="form-control" placeholder="Remarks"></textarea>
                                <div class="mt-4">
                                    <select class="form-select" name="star" id="" required>
                                        <option value="" selected disabled> SELECT STAR</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                                <button class="btn btn-primary mt-4">Submit Review</button>
                            </form>
                        </x-modal>
                    </div>
                @endif
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-12 col-md-6">
                <div class="card mt-2">
                    <div class="card-header">
                        FOLLOWERS
                    </div>
                    <div class="card-body">
                        <h2 class="text-center follow-count">
                            {{$followersCount}}
                        </h2>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card mt-2">
                    <div class="card-header">
                        POSTS
                    </div>
                    <div class="card-body">
                        <h2 class="text-center">
                            {{$postsCount}}
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-8">

        <div class="card">
            <div class="card-header">
                Posts
            </div>
            <div class="card-body">
                <ul class="list-group">
                    @forelse ($posts as $post)
                        <x-post-item :post="$post"></x-post-item>
                    @empty
                        <li class="list-group-item">
                            No post to show
                        </li>
                    @endforelse
                </ul>

                <div class="mt-2 d-flex justify-content-end">
                    {{$posts->links()}}
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                Reviews
            </div>
            <div class="card-body">
                <ul class="list-group">
                    @foreach ($reviews as $review)
                        <x-review-item :review="$review"></x-review-item>
                    @endforeach
                </ul>
                <div class="mt-4 d-flex justify-content-end">
                    {{$reviews->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
