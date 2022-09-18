@props(['links' => []])
<nav aria-label="breadcrumb">
    <ol class="breadcrumb my-0 ms-2">
        @foreach ($links as $item)
            <li class="breadcrumb-item {{$item['active'] ? 'active': ''}}"><a style="text-decoration: none !important;" href="{{$item['link']}}">{{$item['label']}}</a></li>
        @endforeach
    </ol>
</nav>
