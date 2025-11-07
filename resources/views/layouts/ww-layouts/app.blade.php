<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width" initial-scale=1.0>
    <title>@yield('title') | WelkinWonders</title>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('/assets/img/favicon_crystal.png') }}">
    @vite(['resources/css/style.css'])
    @yield('style')
</head>
<body>
    @yield('banner')
    <x-ww-components.navigation></x-ww-components.navigation> <!-- Navigation bar -->
    @yield('content')
</body>
</html>
