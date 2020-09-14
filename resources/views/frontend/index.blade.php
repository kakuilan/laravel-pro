<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
    <h2>Home,Index</h2>
    <div>
        <form method="POST" action="/">
            {{ csrf_field() }}
        </form>
    </div>
</body>
</html>
