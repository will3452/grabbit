@props(['post'])
<li class="list-group-item">
    <div class="d-flex justify-content-between">
        <div  class="d-flex align-items-center">
            <img src="{{$post->getExploadImage( $post->getPostImage()[0]->image)}}" alt="" class="border rounded " style="width: 40px; height: 40px">
            <div style="margin-left: 1em">
                <a style="text-decoration: none;" href="{{route('post.show', ['post' => $post->id])}}">{{$post->title}}</a>
                <div class="text-secondary" style="font-size: 10px">
                    {{$post->created_at->diffForHumans()}} | ❤️ {{$post->likes()->count()}}
                </div>
                <div style="font-size:12px">
                    {{$post->descriptions}}
                </div>
                @if (auth()->user()->id == $post->user_id)
                    <a href="/posts/edit/{{$post->id}}" class="btn btn-primary mt-2">Edit</a>
                @endif
            </div>
        </div>

    </div>

</li>
