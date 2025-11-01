<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="/dashboard" method="POST">
        @csrf
        <button>Dashboard</button>
    </form>
    <div style="border: 3px solid black; margin-bottom: 10px;">
        <h2>Posts</h2>
        @foreach ($posts as $post)
        <div style="background-color: gray; padding: 10px; margin: 10px;">
            <h3>{{$post['title']}} by {{$post->searchAuthor->name}}</h3>
            <img src="{{ asset('storage/' . $post->image) }}">
            {{$post['instagram_url']}}
        </div>
        @endforeach
    </div>
</body>
</html>