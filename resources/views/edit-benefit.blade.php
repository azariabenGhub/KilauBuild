<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Edit Post</h1>
    <form action="/edit-benefit/{{$bnft->id}}" method="POST">
        @csrf
        @method('PUT')
        <input name="title" type="text" placeholder="Judul Keunggulan..." value="{{$bnft->title}}">
        <textarea name="desc" type="text" placeholder="Deskripsi..." value="{{$bnft->desc}}"></textarea>
        <input name="image" type="file" placeholder="Gambar.." value="{{$bnft->image}}">
        <button>Save Changes</button>
    </form>
</body>
</html>