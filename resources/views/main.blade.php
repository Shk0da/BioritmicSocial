<!DOCTYPE html>
<html>
<head>
    <title>{{ $meta['title'] ?: $meta['title'] }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $meta['description'] ?: '' }}">
    <meta name="keywords" content="{{ $meta['keywords'] ?: '' }}">
    <link rel="shortcut icon" href="/public/favicon.jpg" type="image/png" />
    <link href="/public/css/style.css" rel="stylesheet">
</head>
<body class="anf">
    @yield('content')
    @include('layout.footer')
</body>
</html>
