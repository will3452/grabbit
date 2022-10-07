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
                <div class="text-center">
                    <div style="font-size: 18px; text-transform: uppercase; letter-spacing: 0.25em">
                        {{ $profile->user->name }}
                    </div>
                    <div>
                        <small class="text-secondary">
                            {{$profile->user->email}} | {{$profile->phone}}
                        </small>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <x-review-stars></x-review-stars>
                </div>
                @livewire('follow-on-profile', ['user' => $profile->user_id], key($profile->user_id))
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-12 col-md-6">
                <div class="card mt-2">
                    <div class="card-header">
                        FOLLOWERS
                    </div>
                    <div class="card-body">
                        <h2 class="text-center">
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
                    <x-review-item></x-review-item>
                    <x-review-item></x-review-item>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
