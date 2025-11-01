<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Edit Post</h1>
    <form action="/edit-desain-interior/{{$OP->id}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="text" name="name" value="{{$OP->name}}">
        <input type="file" name="image" value="{{$OP->image}}">
        <button>Save Changes</button>
    </form>
</body>
</html>