<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Petgram</title>
    @yield('styles')
    <link rel="stylesheet" href="/css/Object/component/button.css">
    <link rel="stylesheet" href="/css/Object/component/grid.css">
    <link rel="stylesheet" href="/css/Object/component/modal.css">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
@include('header')
<main>
    @yield('content')
</main>
@include('footer')

@yield('scripts')
</body>
</html>
