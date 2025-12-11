{{-- Name: Liam Willis --}}
{{-- This file defines the structure of every web page of WelkinWonders: it serves as a template --}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width" initial-scale=1.0>
    <title>@yield('title') | WelkinWonders</title>

    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('assets/img/favicon_crystal.png') }}">

    <style>
        #mobile-toggle-custom {
            background-image: url("{{ asset('assets/img/icon_menu_open.svg') }}")
        }
        #mobile-toggle:checked ~ #mobile-toggle-custom {
            background-image: url("{{ asset('assets/img/icon_menu_close.svg') }}");
        }
    </style>

    @vite(['resources/css/style.css'])
    @yield('style')
</head>
<body>
    @yield('banner')
    {{-- Display the navigation bar --}}
    <x-ww_components.navigation></x-ww_components.navigation>
    @yield('content')
    @yield('scripts')
</body>
</html>
