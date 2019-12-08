<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Petgram</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/common.js') }}"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootflat/2.0.4/css/bootflat.min.css">
    <link rel="stylesheet" href="{{ asset('css/Foundation/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Foundation/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Layout/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Layout/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Layout/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Layout/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Object/component/button.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Object/component/grid.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Object/component/modal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Object/component/form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Object/utility.css') }}">
    @yield('styles')
</head>
<body data-route="{{ Route::currentRouteName() }}" class="auth_layout">
<header>
    @yield('header')
</header>
<main>
    @yield('movie')

    @yield('content')
</main>

@yield('scripts')
</body>
</html>
