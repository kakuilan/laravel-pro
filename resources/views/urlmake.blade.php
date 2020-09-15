<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<p>
    <a href="{{$url}}">跳转链接</a>
</p>
</body>
</html>
