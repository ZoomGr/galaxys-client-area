<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0,user-scalable=0">
    <meta name="referrer" content="origin-when-cross-origin" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <meta property="og:title" content="@yield('title')">
    <meta property="og:description" content="@yield('description')">
    <meta property="og:image" content="@yield('image')">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/x-icon" href="{{asset('favicon.ico')}}">
    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('assets/img/fav/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('assets/img/fav/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('assets/img/fav/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/fav/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('assets/img/fav/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('assets/img/fav/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('assets/img/fav/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('assets/img/fav/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/img/fav/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{asset('assets/img/fav/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/img/fav/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('assets/img/fav/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/img/fav/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('assets/img/fav/manifest.json')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{asset('assets/img/fav/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#ffffff">

    <link rel="stylesheet" href="{{asset('assets/css/libs.css.php')}}" />
    <link rel="preload" as="style" href="{{asset('assets/css/top.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/top.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/theme.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    @yield('styles')

    <!-- Scripts -->
</head>
<body>
    @php
        $chat_notification_helper = new \App\Helpers\NotificationHelper(new \App\Services\ChatNotificationsService());
    @endphp
    @if(auth()->check())
        @include('layouts.partials.header')
    @endif
    <main class="main-page">
        <div class="main-page__bg">
            <img src="{{asset('assets/img/theme/bg.png')}}" alt="bg">
        </div>
        @yield('content')
    </main>
    @yield('startScripts')
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script defer src="{{asset('assets/js/libs.js.php')}}"></script>
    <script defer src="{{asset('assets/js/utils/functions.js')}}"></script>
    <script defer src="{{asset('assets/js/main.js')}}"></script>

    @yield('scripts')
</body>
</html>