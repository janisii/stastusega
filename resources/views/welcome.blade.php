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

    <!-- FavIcon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png') }}"/>

    <!-- Assets -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>
<body class="welcome">
    <div id="app">
        <div class="container d-flex h-100">
            <div class="col text-center justify-content-center align-self-center">
                <h2 class="text-center text-muted">{{ config('app.name') }}</h2>
                <img src="{{ asset('images/lv100.png') }}" alt="Latvija 100" class="mt-5 mb-5 img-fluid"/>
                <p class="text-muted font-14">Ogres sākumskolas projekts veltīts Latvijas simtgadei.<br/>Projekts šobrīd ir izstrādes stadijā, aicinām pie mums iegriezties vēlreiz.</p>
            </div>
        </div>
    </div>
</body>
</html>