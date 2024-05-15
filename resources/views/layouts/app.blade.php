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

    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/img/fav/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/img/fav/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/img/fav/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('assets/img/fav/site.webmanifest')}}">
    <link rel="shortcut icon" href="{{asset('assets/img/fav/favicon.ico')}}">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="{{asset('assets/img/fav/browserconfig.xml')}}">
    <meta name="theme-color" content="#ffffff">

    <link rel="stylesheet" href="{{asset('assets/css/libs.css.php')}}" />
    <link rel="preload" as="style" href="{{asset('assets/css/top.css?') . filemtime('assets/css/top.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/top.css?') . filemtime('assets/css/top.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/theme.css?') . filemtime('assets/css/theme.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/app.css?') . filemtime('assets/css/app.css')}}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    @yield('styles')
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-P6F228C6');
    </script>
    <!-- End Google Tag Manager -->

    <!-- Scripts -->
</head>
<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P6F228C6"
                      height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->
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
    <script defer src="{{asset('assets/js/libs.js.php?') . filemtime('assets/js/libs.js.php')}}"></script>
    <script defer src="{{asset('assets/js/utils/functions.js?') . filemtime('assets/js/utils/functions.js')}}"></script>
    <script defer src="{{asset('assets/js/main.js?') . filemtime('assets/js/main.js') }}"></script>

    @yield('scripts')
</body>
</html>
