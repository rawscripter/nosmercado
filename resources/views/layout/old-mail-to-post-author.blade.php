<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<body>
<h1 style="text-align: center">Congratulation! You Post Has Been Published.</h1>
<br>
<p>Title: {{$data->title}}</p>
<p>Category: {{$data->category->name}}</p>
<p>Sub Category: {{$data->subCategory->name}}</p>
<p>Price: {{$data->price}}</p>
<p>Description: {{$data->description}}</p>
<br>
<br><br>

@php
    $url = '/destroy/';
    $url .= base64_encode($data->id) . '/';
    $url .= base64_encode($data->title) . '/';
    $url .= base64_encode($data->email) . '/';
    $url .= base64_encode($data->expire_date);
    $link = url($url);
@endphp

<p>If you want to delete the post click on the link: <a href="{{$link}}">{{$link}}</a></p>
</body>
</html>