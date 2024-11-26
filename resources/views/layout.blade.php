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

        @wireUiScripts
        <script src="//unpkg.com/alpinejs" defer></script>
        <script src="{{ asset('assets/fontawesome.js') }}" crossorigin="anonymous"></script>
    </head>
    <body class="flex flex-col min-h-screen bg-background">

        {{-- Ordinateur --}}
        <nav class="p-8 bg-background">
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
                    {{-- Composant WireUI Dropdown --}}
                    <x-dropdown>
                        <x-slot name="trigger">
                            <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('assets/default_pfp.png') }}" alt="Avatar" class="rounded-full size-12">
                        </x-slot>

                        <x-dropdown.header class="md:text-gray-400" label="Menus" />
                            <x-dropdown.item href="{{ route('user.index') }}" class="md:text-black md:hover:text-black md:hover:bg-primary-100" icon="user-circle" label="Profil" />
                            <x-dropdown.item href="{{ route('user.index') }}" class="md:text-black md:hover:text-black md:hover:bg-primary-100" icon="chat-bubble-left-right" label="Messages" />
                            <x-dropdown.item href="{{ route('user.index') }}" class="md:text-black md:hover:text-black md:hover:bg-primary-100" icon="shopping-cart" label="Achats" />
                        <x-dropdown.header />

                        <x-dropdown.header separator class="md:text-gray-400" label="Actions" />
                            <x-dropdown.item href="#" class="md:text-error-500 md:hover:text-black md:hover:bg-primary-100" icon="arrow-right-start-on-rectangle" label="Se déconnecter" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" />
                            <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                        <x-dropdown.header />
                    </x-dropdown>
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
                <a href="{{ route('home') }}" class="flex flex-col items-center justify-center h-full gap-3 {{ Route::is('home') ? 'text-primary-500' : 'text-gray-400' }}">
                    <i class="fa-regular fa-house fa-xl"></i><span class="text-sm">Accueil</span>
                </a>
                <a href="{{ route('home') }}" class="flex flex-col items-center justify-center h-full gap-3 {{ Route::is('home') ? 'text-primary-500' : 'text-gray-400' }}">
                    <i class="fa-regular fa-car-side fa-xl"></i><span class="text-sm">Acheter</span>
                </a>
                <a href="{{ route('home') }}" class="flex flex-col items-center justify-center h-full gap-3 {{ Route::is('home') ? 'text-primary-500' : 'text-gray-400' }}">
                    <i class="fa-regular fa-building-columns fa-xl"></i><span class="text-sm">Enchérir</span>
                </a>
                <a href="{{ route('home') }}" class="flex flex-col items-center justify-center h-full gap-3 {{ Route::is('home') ? 'text-primary-500' : 'text-gray-400' }}">
                    <i class="fa-regular fa-messages fa-xl"></i><span class="text-sm">Messagerie</span>
                </a>
                <a href="{{ route(auth()->check() ? 'user.index' : 'auth.login') }}" class="flex flex-col items-center justify-center h-full gap-3 {{ Route::is(auth()->check() ? ['user.index', 'user.edit'] : 'auth.login') ? 'text-primary-500' : ' text-gray-400' }}">
                    <i class="fa-regular fa-user fa-xl"></i><span class="text-sm">Profil</span>
                </a>
            </div>
        </div>

        <div class="flex-grow md:mx-16 md:my-16">

            @yield('contenu')
            
        </div>

        {{-- Footer --}}
        <footer class="px-2 py-8 mb-16 md:p-8 md:mb-0 bg-background top-full">
            <div class="flex flex-col gap-4">
                <div class="justify-between hidden md:flex">
                    <div class="flex items-center gap-2">
                        <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="h-10 mb-2">
                        <span class="text-base">AutoMarket</span>
                    </div>
                    <form action="" class="flex h-10"> {{-- A remplacer par route newsletter --}}
                        <input type="email" class="w-48 px-4 py-2 text-xs border border-gray-300 rounded-l-lg" placeholder="Entrez votre e-mail">
                        <button type="submit" class="px-4 py-2 text-xs text-white transition-all duration-300 rounded-r-lg bg-primary-500 hover:bg-primary-400">S'abonner</button>
                    </form>
                </div>
                <div class="flex flex-col-reverse items-center justify-center gap-4 md:flex-row md:justify-between">
                    <span class="text-xs text-gray-500 md:hidden">©2024 AutoMarket</span>
                    <div class="flex gap-2">
                        <a href="https://twitter.com" target="_blank" class="text-gray-500 hover:text-gray-700">
                            <i class="fa-brands fa-twitter fa-xl"></i>
                        </a>
                        <a href="https://facebook.com" target="_blank" class="text-gray-500 hover:text-gray-700">
                            <i class="fa-brands fa-facebook fa-xl"></i>
                        </a>
                        <a href="https://linkedin.com" target="_blank" class="text-gray-500 hover:text-gray-700">
                            <i class="fa-brands fa-linkedin fa-xl"></i>
                        </a>
                    </div>
                    <div class="flex gap-2 md:gap-4">
                        <a href="{{ route('home') }}" class="text-xs text-gray-500 hover:text-gray-700">A propos de nous</a>
                        <a href="{{ route('home') }}" class="text-xs text-gray-500 hover:text-gray-700">Conditions Générales</a>
                        <a href="{{ route('home') }}" class="text-xs text-gray-500 hover:text-gray-700">Politique de confidentialité</a>
                    </div>
                    <span class="hidden text-xs text-gray-500 md:block">©2024 AutoMarket</span>
                </div>
            </div>
        </footer>
    </body>
</html>
