<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Vroum Vroum - @yield('titre')</title>

        @vite('resources/css/app.css')
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    </head>
    <body class="bg-background">
        <nav class="p-8">
            <div class="container flex items-center justify-between mx-auto">
                <div class="text-2xl">VroumVroum 🚗💨</div>
                <div class="flex items-center gap-12">
                    <a href="{{ route('home') }}" class="nav-link {{ Route::is('home') ? 'active' : '' }}">Accueil</a>
                    <a href="{{ route('home') }}" class="nav-link">Acheter</a>
                    <a href="{{ route('home') }}" class="nav-link">Enchérir</a>
                    <a href="{{ route('home') }}" class="nav-link">Vendre</a>
                    @auth
                        <span class="flex items-center">
                            <span class="w-3 h-3 mr-2 bg-green-500 rounded-full"></span>
                            <span>{{ Auth::user()->name }}</span>
                        </span>
                        <form action="{{ route('auth.logout') }}" method="POST" class="inline">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="px-4 py-2 text-white bg-error-500 rounded-md hover:bg-error-400 transition-all duration-300">Déconnexion</button>
                        </form>
                    @endauth
        
                    @guest
                        <a class="px-4 py-2 text-white rounded-lg bg-primary-500 hover:bg-primary-400 transition-all duration-300" href="{{ route('auth.login') }}">Connexion</a>
                    @endguest
                </div>
            </div>
        </nav>

        <div class="mx-16 my-16">

            @yield('contenu')
            
        </div>
    </body>
</html>
