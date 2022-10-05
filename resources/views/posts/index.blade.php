@extends('layouts.app')

@section('breadcrumb')
    <x-breadcrumb :links="[
        [
            'label' => 'Home',
            'link' => '/home',
            'active' => false,
        ],
        [
            'label' => 'Posts',
            'link' => '/posts',
            'active' => true
        ]
    ]"/>
@endsection
@section('content')
    @livewire('post-livewire')
    <div class="card mt-3">
        <div class="card-header">Search Post</div>
        <form class="card-body" method="GET" action="">
            <div class="form-group">
                <input name="search" type="text" class="form-control" value="{{ $data }}" placeholder="Search...">
            </div>
            <div class="mt-2 form-group" style="text-align:right !important;">
                <button type="submit" class="btn btn-primary">
                    Search
                </button>
            </div>
        </form>
    </div>
    @foreach ($posts as $post)
        @if (!$post->CheckUserBlock())
        <div class="card mt-2 {{'block_post_hide_'.$post->user_id}}">
            <div class="card-header d-flex justify-content-between align-items-baseline">
                <div class="d-flex align-items-baseline">
                    @if (!$post->checkUserAuthPost())
                        <div style="margin-right:-10px;">
                            <a class="header-brand" href="/convo/message/{{$post->getProfilePost()->id}}">
                                <svg class="icon icon-lg">
                                    <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-comment-square"></use>
                                </svg>
                            </a>
                        </div>
                    @endif
                    <div>{{ucfirst($post->getUserPost()->name)}}</div>
                    @if (!$post->checkUserAuthPost())
                    <form class="followform " method="POST">
                        @csrf
                        <input type="hidden" value="{{$post->getProfilePost()->id}}" name="following_id">

                        @if ($post->checkUserFollowStatus())
                            <button class="btn-link outline-none {{'followbtn_'.$post->getProfilePost()->id}}"  type="submit">Unfollow</button>
                        @else
                            <button class="btn-link outline-none {{'followbtn_'.$post->getProfilePost()->id}}" type="submit">Follow</button>
                        @endif
                    </form>
                    @endif
                    @if (!$post->checkUserAuthPost())
                        {{-- <livewire:block :user_block="$post->user_id" :key="$post->user_id"> --}}
                        <form class="blockform" method="POST">
                            @csrf
                            <input type="hidden" value="{{$post->user_id}}" name="blocked_id">
                            <button class="btn-link outline-none" type="submit">Block</button>
                        </form>
                    @endif
                </div>
                <div>
                    @if (!$post->checkUserAuthPost())
                        <a href="{{url('meetup/create')}}/{{$post->id}}" class="btn btn-outline-primary">Meetup Request</a>
                    @endif
                </div>
            </div>
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        {{$post->title}}
                    </div>
                    <div style="font-size:12px;">
                        {{$post->created_at->diffForHumans()}}
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div>
                    {{$post->descriptions}}
                </div>
                <div>
                    <a target="_blank" href="{{$post->getPublicImage()}}"><img style="max-height:300px !important;" src="{{$post->getPublicImage()}}" alt=""></a>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <div>
                        <livewire:like :post="$post->id" :key="$post->id">
                    </div>
                    @if (!$post->checkUserAuthPost())
                    <div>
                        <a href="/report/post/{{$post->id}}" class="reports">
                            <svg class="icon icon-lg">
                                <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-flag-alt"></use>
                            </svg>
                        </a>
                    </div>
                    @endif
                </div>
            </div>
            <div class="card-footer">
                <livewire:comment :post="$post->id" :key="$comment->id"/>
            </div>
        </div>
        @endif
    @endforeach
    <div class="mt-4">
    {{$posts->links()}}
    </div>
    <script src="{{ asset('js/posts.js') }}"></script>
@endsection
