<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Petgram</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Object/utility.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Foundation/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Layout/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Layout/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Layout/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Object/component/button.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Object/component/grid.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Object/component/modal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Object/component/form.css') }}">
    @yield('styles')
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
