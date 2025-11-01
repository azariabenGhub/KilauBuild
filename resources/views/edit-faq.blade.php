<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Edit Post</h1>
    <form action="/edit-faq/{{$faq->id}}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="question" value="{{$faq->question}}">
        <input type="text" name="answer" value="{{$faq->answer}}">
        <button>Save Changes</button>
    </form>
</body>
</html>