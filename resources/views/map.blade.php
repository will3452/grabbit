<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Map</title>

    <script src="/js/app.js" defer></script>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
    <h1 class="text-center">Pin location</h1>
    {{$post}}
    <div id="app">
        <grab-map
        @if (request()->read)
            latx="{{$post->lat}}"
            lngx="{{$post->lng}}"
        @endif

        save-url="{{route('post.update', ['post' => request()->post])}}" read-only="{{request()->read ? true: false}}"></grab-map>
    </div>
</body>
</html>
