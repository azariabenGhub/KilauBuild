<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Edit Post</h1>
    <form action="/edit-visi-misi/{{$VM->id}}" method="POST">
        @csrf
        @method('PUT')
        <textarea name="visi" type="text" placeholder="Visi..." value="{{$VM->visi}}"></textarea>
        <textarea name="misi" type="text" placeholder="Misi..." value="{{$VM->misi}}"></textarea>
        <button>Save Changes</button>
    </form>
</body>
</html>