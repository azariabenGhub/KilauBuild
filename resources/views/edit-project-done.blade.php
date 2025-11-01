<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Edit Post</h1>
    <form action="/edit-project-done/{{$PD->id}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="text" name="name" value="{{$PD->name}}">
        <input type="text" name="desc" value="{{$PD->desc}}">
        <input type="text" name="year" value="{{$PD->year}}">
        <input type="file" name="image" value="{{$PD->image}}">
        <button>Save Changes</button>
    </form>
</body>
</html>