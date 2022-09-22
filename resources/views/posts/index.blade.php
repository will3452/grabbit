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
    <div class="card">
        <div class="card-header">Create new post</div>
        <form class="card-body" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <input required name="title" type="text" class="form-control" placeholder="title">
            </div>
            <div class="form-group mt-2">
                <textarea required name="descriptions" placeholder="descriptions" class="form-control" id="description" rows="3"></textarea>
            </div>
            <div class="form-group mt-2">
                <input required type="file" name="attachments">
            </div>
            <div class="mt-2 form-group" style="text-align:right !important;">
                <button type="submit" class="btn btn-primary">
                    Create new post
                </button>
            </div>
        </form>
    </div>
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
        <div class="card mt-2">
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
                <hr>
                <form class="likeform d-flex" method="POST">
                    <div class="{{'totallike_'.$post->id}} p-1">{{$post->calculate_like()}}</div>
                    @csrf
                    <input class="post-{{$post->id}}" type="hidden" value="{{$post->id}}" name="likeinput">
                    <button type="submit" class="remove_outline_button">

                            <svg class="icon me-2  @if ($post->check_like_by_user()) color_like @endif {{'like_'.$post->id}}">
                                <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-thumb-up"></use>
                            </svg>

                    </button>
                </form>
            </div>
            <div class="card-footer">
                <div>
                    <h6>Comments
                        @if ($post->getCommentsCount() != 0)
                            <div class="badge bg-primary">{{$post->getCommentsCount()}}</div>
                        @endif
                    </h6>
                    <form action="{{route('comment.new')}}" method="POST" class="comment-form">
                        @csrf
                        <input type="hidden" name="model_type" value="\App\Models\Post">
                        <input type="hidden" name="model_id" value="{{$post->id}}">
                        <textarea name="value" placeholder="Aa" max="100" max-length="100" class="form-control"></textarea>
                        <div style="text-align:right !important;" class="text-right mt-2">
                            <button type="submit" class="btn btn-primary">submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    <script src="{{ asset('js/posts.js') }}" defer></script>
@endsection
