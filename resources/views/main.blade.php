<!DOCTYPE html>
<html>
<head>
    <title>Main</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link href="/public/css/style.css" rel="stylesheet">
</head>
<body class="anf">
    @if ( isset($info) )
        <p class="bg-info"><?= $info ?></p>
    @endif
    @yield('content')
    @include('footer')
</body>
</html>
