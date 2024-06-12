<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="{{route('articles.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="text" name="title">
    <input type="file" multiple name="paths[]">
    <button type="submit">Store</button>
</form>
</body>
</html>
