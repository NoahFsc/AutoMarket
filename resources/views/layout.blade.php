<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>AutoMarket - @yield('titre')</title>

        @vite('resources/css/app.css')
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/logo.ico') }}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
        <script src="{{ asset('assets/fontawesome.js') }}" crossorigin="anonymous"></script>
    </head>
    <body class="bg-background">

        {{-- Ordinateur --}}
        <nav class="p-8">
            <div class="flex items-center mx-auto md:justify-between">
                <div class="flex items-center gap-2">
                    <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="h-12 mb-2">
                    <span class="text-2xl font-medium">AutoMarket</span>
                </div>
                <div class="items-center hidden gap-12 md:flex">
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
                            <button type="submit" class="px-4 py-2 text-white transition-all duration-300 rounded-md bg-error-500 hover:bg-error-400">Déconnexion</button>
                        </form>
                    @endauth
        
                    @guest
                        <a class="px-4 py-2 text-white transition-all duration-300 rounded-lg bg-primary-500 hover:bg-primary-400" href="{{ route('auth.login') }}">Connexion</a>
                    @endguest
                </div>
            </div>
        </nav>

        {{-- Mobile --}}
        <div class="fixed bottom-0 left-0 right-0 md:hidden">
            <div class="flex items-end justify-around pb-2 bg-white min-h-[64px]">
                @php
                    $links = [
                        ['route' => 'home', 'icon' => 'fa-house', 'label' => 'Accueil'],
                        ['route' => 'home', 'icon' => 'fa-car-side', 'label' => 'Acheter'],
                        ['route' => 'home', 'icon' => 'fa-building-columns', 'label' => 'Enchérir'],
                        ['route' => 'home', 'icon' => 'fa-messages', 'label' => 'Messagerie'],
                        ['route' => auth()->check() ? 'user.index' : 'auth.login', 'icon' => 'fa-user', 'label' => 'Profil'],
                    ];
                @endphp
        
                @foreach ($links as $link)
                    <a href="{{ route($link['route']) }}" class="flex flex-col items-center justify-center h-full gap-3 {{ Route::is($link['route']) ? 'text-primary-500' : '' }}">
                        <i class="fa-regular {{ $link['icon'] }} fa-xl"></i>
                        <span class="text-sm">{{ $link['label'] }}</span>
                    </a>
                @endforeach
            </div>
        </div>

        <div class="md:mx-16 md:my-16">

            @yield('contenu')
            
        </div>
    </body>
</html>
