<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<p>
    <h3>表单</h3>
    <form method="POST" action="/formrec">
        @csrf
        姓名：<input type="text" name="name"><br/>
        年龄：<input type="text" name="age"><br/>
        <input type="submit" value="提交">
    </form>
</p>
</body>
</html>
