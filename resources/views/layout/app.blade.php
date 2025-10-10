<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/global.css') }}">

        @yield('styles')

    <body>
        <nav>
            <a href="/">Accueil</a>
            <a href="/connexion">Connexion</a>
            <a href="/inscription">Inscription</a>
        </nav>

        @yield('content')

    </body>
</html>
