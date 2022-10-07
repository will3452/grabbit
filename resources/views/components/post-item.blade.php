@props(['post'])
<li class="list-group-item">
    <div class="d-flex justify-content-between">
        <div  class="d-flex align-items-center">
            <img src="{{$post->getPublicImage()}}" alt="" class="border rounded " style="width: 40px; height: 40px">
            <div style="margin-left: 1em">
                <a style="text-decoration: none;" href="{{route('post.show', ['post' => $post->id])}}">{{$post->title}}</a>
                <div class="text-secondary" style="font-size: 10px">
                    {{$post->created_at->diffForHumans()}} | ❤️ {{$post->likes()->count()}}
                </div>
                <div style="font-size:12px">
                    {{$post->description}}
                </div>
            </div>
        </div>

    </div>

</li>
