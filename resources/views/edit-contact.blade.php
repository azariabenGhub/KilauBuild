<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Edit Post</h1>
    <form action="/edit-contact/{{$cont->id}}" method="POST">
        @csrf
        @method('PUT')
        <input name="no_telp" type="text" placeholder="No Telepon..." value="{{$cont->no_telp}}">
        <input name="alamat" type="text" placeholder="Alamat..." value="{{$cont->alamat}}"></input>
        <input name="link_gmaps" type="text" placeholder="Link Google Maps..." value="{{$cont->link_gmaps}}">
        <input name="email" type="email" placeholder="Email..." value="{{$cont->email}}"></input>
        <input name="url_instagram" type="text" placeholder="Link Instagram..." value="{{$cont->url_instagram}}"></input>
        <input name="url_facebook" type="text" placeholder="Link Facebook..." value="{{$cont->url_facebook}}"></input>
        <input name="url_threads" type="text" placeholder="Link Threads..." value="{{$cont->url_threads}}"></input>
        <input name="url_tiktok" type="text" placeholder="Link Tiktok..." value="{{$cont->url_tiktok}}"></input>
        <input name="url_youtube" type="text" placeholder="Link Youtube..." value="{{$cont->url_youtube}}"></input>
        <input name="url_twitter" type="text" placeholder="Link Twiiter..." value="{{$cont->url_twitter}}"></input>
        <button>Save Changes</button>
    </form>
</body>
</html>