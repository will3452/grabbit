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
    <div class="card mt-3">
        <div class="card-header">Search Post</div>
        <form class="card-body" method="GET" action="/posts">
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
        <div class="card mt-2 {{'delete_post_hide_'.$post->id}} {{'block_post_hide_'.$post->user_id}}">
            <div class="card-header d-flex justify-content-between align-items-baseline">
                <div class="d-flex align-items-baseline letter_spacing padding_post">
                    <a style="text-decoration: none; font-weight:600; color:#1f913b; font-size:16px" href="{{route('profile.show', ['user_id' => $post->user_id])}}">{{ucfirst($post->getUserPost()->name)}}</a>
                </div>
                @if (!$post->checkUserAuthPost())
                    <div class="post_process_dot">
                        <img id="opendot" class="opendot" style="width:30px; height:30px; cursor:pointer;  object-fit: cover;" src="/dot.png" alt="">
                        <div id="show_dot" class="show_acton_dot toggle">
                            <form class="followform" method="POST">
                                @csrf
                                <input type="hidden" value="{{$post->getProfilePost()->id}}" name="following_id">
                                @if ($post->checkUserFollowStatus())
                                    <button class="unfollow-user letter_spacing btn-fl {{'followbtn_'.$post->getProfilePost()->id}}"  type="submit">
                                        Unfollow
                                    </button>
                                @else
                                    <button class="follow-user letter_spacing btn-fl {{'followbtn_'.$post->getProfilePost()->id}}" type="submit">
                                        Follow
                                    </button>
                                @endif
                            </form>
                            <form class="blockform" method="POST">
                                @csrf
                                <input type="hidden" value="{{$post->user_id}}" name="blocked_id">
                                <button class="block-user letter_spacing" type="submit">Block</button>
                           </form>
                            <div>
                                <a href="/convo/message/{{$post->getProfilePost()->id}}"><button class="letter_spacing">Message</button></a>
                            </div>
                            <div>
                                <a href="/meetup/create/{{$post->id}}"><button class="letter_spacing">Request Meetup</button></a>
                            </div>
                            <div>
                                <a href="/report/post/{{$post->id}}"><button class="letter_spacing">Report</button></a>
                            </div>
                        </div>
                    </div>
                @else
                <div class="post_process_dot">
                    <img id="opendot" class="opendot" style="width:30px; height:30px; cursor:pointer;  object-fit: cover;" src="/dot.png" alt="">
                    <div id="show_dot" class="show_acton_dot toggle">
                        <div>
                            <a href="/posts/edit/{{$post->id}}"><button class="letter_spacing">Edit</button></a>
                        </div>
                        <form class="deleteform" method="POST">
                            @csrf
                            <input type="hidden" value="{{$post->id}}" name="post_id">
                            <button class="block-user letter_spacing" type="submit">Delete</button>
                       </form>
                    </div>
                </div>
                @endif
            </div>
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div class="letter_spacing padding_post">
                        {{ucfirst($post->title)}}
                    </div>
                    <div style="font-size:12px;" class="letter_spacing padding_post">
                        {{$post->created_at->diffForHumans()}}
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="post-image-div padding_post">
                    <div>
                       <a target="_blank" href="{{$post->getExploadImage( $post->getPostImage()[0]->image)}}"> <img src="{{ $post->getExploadImage( $post->getPostImage()[0]->image) }}" alt=""></a>
                    </div>
                </div>
                @if ($post->getPostImage()->count() > 1)
                    <div class="post-image-footer padding_post">
                        @foreach ($post->getPostImage() as $index => $itemimg)
                            @if ($index > 0)
                                <div>
                                   <a target="_blank" href="{{ $post->getExploadImage($itemimg->image); }}"> <img class="imagepostview"  src="{{ $post->getExploadImage($itemimg->image); }}" alt=""></a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif
                <div class="description_post letter_spacing padding_post">
                    {{ucfirst($post->descriptions)}}
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <div>
                        <livewire:like :post="$post->id" :key="$post->id">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <livewire:comment :post="$post->id" :key="$comment->id"/>
            </div>
        </div>
    @endforeach
    <div class="mt-4">
        {{$posts->links()}}
    </div>
    <script src="{{ asset('js/posts.js') }}"></script>
@endsection
