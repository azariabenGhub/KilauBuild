<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Edit Post</h1>
    <form action="/edit-post/{{$post->id}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="text" name="title" value="{{$post->title}}">
        <input type="text" name="instagram_url" value="{{$post->instagram_url}}">
        <input type="file" name="image" value="{{$post->image}}">
        <button>Save Changes</button>
    </form>
</body>
</html>