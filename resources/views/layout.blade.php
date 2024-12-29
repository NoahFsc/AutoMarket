<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>AutoMarket - @yield('titre')</title>

    @vite('resources/css/app.css')
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/logo_automarket.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

    <livewire:styles />
    <script src="{{ asset('assets/fontawesome.js') }}" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('livewire:load', function () {
            if (typeof Alpine === 'undefined') {
                var script = document.createElement('script');
                script.src = '//unpkg.com/alpinejs';
                script.defer = true;
                document.head.appendChild(script);
            }
        });
    </script>
</head>

<body class="flex flex-col min-h-screen bg-background">
    <livewire:scripts />
    
    {{-- Ordinateur --}}
    <nav class="p-8 bg-background">
        <div class="flex items-center mx-auto md:justify-between">
            <a href="{{ route('home') }}">
                <div class="flex items-center">
                    <img src="{{ asset('assets/logo_automarket.webp') }}" alt="Logo" class="h-24 mb-2">
                    <span class="text-2xl font-medium">AutoMarket</span>
                </div>
            </a>
            <div class="items-center hidden gap-12 md:flex">
                <a href="{{ route('home') }}" class="nav-link {{ Route::is('home') ? 'active' : '' }}">Accueil</a>
                <a href="{{ route('catalog.acheter') }}" class="nav-link {{ Route::is('catalog.acheter') ? 'active' : '' }}">Acheter</a>
                <a href="{{ route('catalog.encherir') }}" class="nav-link {{ Route::is('catalog.encherir') ? 'active' : '' }}">Enchérir</a>
                <a href="{{ route('home') }}" class="nav-link {{ Route::is('home') ? 'active' : '' }}">Vendre</a>

                @auth
                    <div class="relative inline-block text-left" x-data="{ open: false }">
                        <button @click="open = !open" type="button" class="inline-flex justify-center w-full px-4 py-2 text-sm font-medium rounded-md">
                            <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('assets/default_pfp.png') }}"
                                alt="Avatar" class="rounded-full size-12">
                        </button>
                        <div x-show="open" @click.away="open = false" class="absolute right-0 z-50 w-56 mt-2 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95">
                            <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                                <div class="px-4 py-2 text-xs text-gray-400">Menus</div>
                                <a href="{{ route('user.index', ['id' => Auth::id()]) }}" class="flex items-center gap-2 px-4 py-2 hover:bg-gray-100" role="menuitem">
                                    <i class="fa-regular fa-circle-user"></i> <p>Profil</p>
                                </a>
                                <a href="{{ route('user.index', ['id' => Auth::id()]) }}" class="flex items-center gap-2 px-4 py-2 hover:bg-gray-100" role="menuitem">
                                    <i class="fa-regular fa-message-dots"></i> <p>Messages</p>
                                </a>
                                <a href="{{ route('user.index', ['id' => Auth::id()]) }}" class="flex items-center gap-2 px-4 py-2 hover:bg-gray-100" role="menuitem">
                                    <i class="fa-regular fa-clock-rotate-left"></i> <p>Historique d'achats</p>
                                </a>
                                @if (Auth::user()->is_admin)
                                <a href="{{ route('admin.users-list') }}" class="flex items-center gap-2 px-4 py-2 hover:bg-gray-100" role="menuitem">
                                    <i class="fa-regular fa-gear"></i> <p>Administration</p>
                                </a>
                                @endif
                                <div class="mx-4 mt-2 border-t border-gray-200"></div>
                                <div class="px-4 py-2 text-xs text-gray-400">Actions</div>
                                <a href="#" class="block px-4 py-2 text-error-500 hover:bg-gray-100" role="menuitem"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa-solid fa-arrow-right-start-on-rectangle"></i> Se déconnecter
                                </a>
                                <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </div>
                    </div>
                @endauth

                @guest
                <a class="px-4 py-2 text-white transition-all duration-300 rounded-lg bg-primary-500 hover:bg-primary-400"
                    href="{{ route('auth.login') }}">Connexion</a>
                @endguest
            </div>
        </div>
    </nav>

    {{-- Mobile --}}
    <div class="fixed bottom-0 left-0 right-0 md:hidden z-70">
        <div class="flex items-end justify-around pb-2 bg-white min-h-[64px]">
            <a href="{{ route('home') }}"
                class="flex flex-col items-center justify-center h-full gap-3 {{ Route::is('home') ? 'text-primary-500' : 'text-gray-400' }}">
                <i class="fa-regular fa-house fa-xl"></i><span class="text-sm">Accueil</span>
            </a>
            <a href="{{ route('catalog.acheter') }}"
                class="flex flex-col items-center justify-center h-full gap-3 {{ Route::is('catalog.acheter') ? 'text-primary-500' : 'text-gray-400' }}">
                <i class="fa-regular fa-car-side fa-xl"></i><span class="text-sm">Acheter</span>
            </a>
            <a href="{{ route('catalog.encherir') }}"
                class="flex flex-col items-center justify-center h-full gap-3 {{ Route::is('catalog.encherir') ? 'text-primary-500' : 'text-gray-400' }}">
                <i class="fa-regular fa-building-columns fa-xl"></i><span class="text-sm">Enchérir</span>
            </a>
            <a href="{{ route('home') }}"
                class="flex flex-col items-center justify-center h-full gap-3 {{ Route::is('home') ? 'text-primary-500' : 'text-gray-400' }}">
                <i class="fa-regular fa-messages fa-xl"></i><span class="text-sm">Messagerie</span>
            </a>
            @if(auth()->check())
                <a href="{{ route('user.index', ['id' => Auth::id()]) }}"
                    class="flex flex-col items-center justify-center h-full gap-3 {{ Route::is(['user.index', 'user.edit']) ? 'text-primary-500' : 'text-gray-400' }}">
                    <i class="fa-regular fa-user fa-xl"></i><span class="text-sm">Profil</span>
                </a>
            @else
                <a href="{{ route('auth.login') }}"
                    class="flex flex-col items-center justify-center h-full gap-3 {{ Route::is('auth.login') ? 'text-primary-500' : 'text-gray-400' }}">
                    <i class="fa-regular fa-user fa-xl"></i><span class="text-sm">Profil</span>
                </a>
            @endif
        </div>
    </div>

    <div class="flex-grow flex flex-col {{ request()->is('admin/*') ? '' : 'md:mx-16 md:my-16'}}">

        @yield('contenu')

    </div>

    {{-- Footer --}}
    <footer class="px-2 py-8 mb-16 md:p-8 md:mb-0 bg-background top-full">
        <div class="flex flex-col gap-4">
            <div class="justify-between hidden md:flex">
                <div class="flex items-center gap-2">
                    <img src="{{ asset('assets/logo_automarket.webp') }}" alt="Logo" class="h-10 mb-2">
                    <span class="text-base">AutoMarket</span>
                </div>
                <form action="" class="flex h-10"> {{-- A remplacer par route newsletter --}}
                    <input type="email" class="w-48 px-4 py-2 text-xs border border-gray-300 rounded-l-lg"
                        placeholder="Entrez votre e-mail">
                    <button type="submit"
                        class="px-4 py-2 text-xs text-white transition-all duration-300 rounded-r-lg bg-primary-500 hover:bg-primary-400">S'abonner</button>
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
                    <a href="{{ route('home') }}" class="text-xs text-gray-500 hover:text-gray-700">Conditions
                        Générales</a>
                    <a href="{{ route('home') }}" class="text-xs text-gray-500 hover:text-gray-700">Politique de
                        confidentialité</a>
                </div>
                <span class="hidden text-xs text-gray-500 md:block">©2024 AutoMarket</span>
            </div>
        </div>
    </footer>
</body>

</html>