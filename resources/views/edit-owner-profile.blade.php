<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Edit Post</h1>
    <form action="/edit-owner-profile/{{$owp->id}}" method="POST">
        @csrf
        @method('PUT')
        <input name="name" type="text" placeholder="Nama Owner..." value="{{$owp->name}}">
        <textarea name="desc" type="text" placeholder="Deskripsi..." value="{{$owp->desc}}"></textarea>
        <input name="url_instagram" type="text" placeholder="Link Instagram..." value="{{$owp->url_instagram}}">
        <input name="url_linkedin" type="text" placeholder="Link Linkedin..." value="{{$owp->url_linkedin}}">
        <input type="file" name="image" value="{{$owp->image}}">
        <button>Save Changes</button>
    </form>
</body>
</html>