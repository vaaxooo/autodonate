<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="js">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Game Hosting">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">
    <title>@yield('title') – {{ env('APP_NAME') }}</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('assets/css/dashlite_old.css?ver=2.4.0') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/theme.css?ver=2.4.0') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
</head>

<body class="nk-body bg-white npc-default has-aside ">
<div class="nk-app-root">
    <!-- main @s -->
    <div class="nk-main ">
        <!-- wrap @s -->
        <div class="nk-wrap ">
        <!-- content @s -->
            <div class="nk-content ">
                <div class="container wide-xl">
                    <div class="nk-content-inner">
                        <div class="nk-content-body">
                            <div class="nk-content-wrap">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content @e -->
        </div>
        <!-- wrap @e -->
    </div>
    <!-- main @e -->
</div>
<!-- app-root @e -->
<!-- JavaScript -->
<script src="{{ asset('assets/js/bundle.js?ver=2.4.0') }}"></script>
<script src="{{ asset('assets/js/scripts.js?ver=2.4.0') }}"></script>
</body>

</html>
