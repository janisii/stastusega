<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @if (\Illuminate\Support\Facades\App::environment('local'))
            [DEV]
        @endif
        {{ config('app.name', 'Laravel') }}
    </title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png') }}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.4.1/css/swiper.min.css">
    <link href="{{ mix('css/public.css') }}" rel="stylesheet" type="text/css">
    <script src="https://cdn.polyfill.io/v2/polyfill.min.js"></script>
    {{script_json_import()}}
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-39290166-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-39290166-3');
    </script>
</head>
<body>
<div id="root"></div>
<script src="{{ mix('js/public.js') }}" defer></script>
</body>
</html>