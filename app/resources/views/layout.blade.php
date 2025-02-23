<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: false }" x-init="darkMode = localStorage.getItem('theme') === 'dark'; $watch('darkMode', value => { localStorage.setItem('theme', value ? 'dark' : 'light'); document.documentElement.setAttribute('data-theme', value ? 'dark' : 'light'); })" :class="{ 'dark': darkMode }">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>AutoMarket - @yield('titre')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/logo_automarket.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

    <livewire:styles />
    <link rel="stylesheet" href="https://noahfsc.github.io/FontAwesome-6.2.0-Pro/css/all.min.css" >
    <script>
        // Définis le thème en fonction de la valeur stockée dans le localStorage
        (function () {
            const theme = localStorage.getItem('theme');
            if (theme === 'dark') {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
            document.documentElement.setAttribute('data-theme', theme);
            document.documentElement.setAttribute('data-theme-loaded', '');
        })();
    </script>
</head>

<body class="flex flex-col min-h-screen bg-background text-default">
    <livewire:scripts />

    {{-- Ordinateur --}}
    <nav class="p-8 bg-background">
        <div class="flex items-center mx-auto md:justify-between">
            <a href="{{ route('home') }}">
                <div class="flex items-center">
                    <img :src="darkMode ? '{{ asset('assets/logo_automarket_light.png') }}' : '{{ asset('assets/logo_automarket.webp') }}'" alt="Logo" class="h-24 mb-2">
                    <span class="text-2xl font-medium">AutoMarket</span>
                </div>
            </a>
            <div class="items-center hidden gap-12 md:flex">
                <a href="{{ route('home') }}" class="nav-link {{ Route::is('home') ? 'active' : '' }}">{{ __('NavHome') }}</a>
                <a href="{{ route('catalog.acheter') }}"
                    class="nav-link {{ Route::is('catalog.acheter') ? 'active' : '' }}">{{ __('NavBuy') }}</a>
                <a href="{{ route('catalog.encherir') }}"
                    class="nav-link {{ Route::is('catalog.encherir') ? 'active' : '' }}">{{ __('NavBid') }}</a>
                <a href="{{ route('vendre.index') }}"
                    class="nav-link {{ Route::is('vendre.index') ? 'active' : '' }}">{{ __('NavSell') }}</a>

                @auth
                    <div class="relative inline-block text-left" x-data="{ open: false }">
                        <button @click="open = !open" type="button" class="inline-flex justify-center w-full px-4 py-2 text-sm font-medium rounded-md">
                            <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('assets/default_pfp.png') }}"
                                alt="Avatar" class="rounded-full size-12">
                        </button>
                        <div x-cloak x-show="open" @click.away="open = false" class="absolute right-0 z-50 w-56 mt-2 rounded-md shadow-lg bg-input ring-1 ring-black ring-opacity-5" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95">
                            <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                                <div class="px-4 py-2 text-xs text-default/40">{{ __('DropdownMenu') }}</div>
                                <a href="{{ route('user.index', ['id' => Auth::id()]) }}" class="flex items-center gap-2 px-4 py-2 hover:bg-default/10" role="menuitem">
                                    <i class="fa-regular fa-circle-user"></i> <p>{{ __('DropdownProfile') }}</p>
                                </a>
                                <a href="{{ route('chat.index', ['id' => Auth::id()]) }}" class="flex items-center gap-2 px-4 py-2 hover:bg-default/10" role="menuitem">
                                    <i class="fa-regular fa-message-dots"></i> <p>{{ __('DropdownMessages') }}</p>
                                </a>
                                <a href="{{ route('user.index', ['id' => Auth::id()]) }}" class="flex items-center gap-2 px-4 py-2 hover:bg-default/10" role="menuitem">
                                    <i class="fa-regular fa-clock-rotate-left"></i> <p>{{ __('DropdownHistory') }}</p>
                                </a>
                                @if (Auth::user()->is_admin)
                                <a href="{{ route('admin.users-list') }}" class="flex items-center gap-2 px-4 py-2 hover:bg-default/10" role="menuitem">
                                    <i class="fa-regular fa-gear"></i> <p>{{ __('DropdownAdmin') }}</p>
                                </a>
                                @endif
                                <div class="mx-4 mt-2 border-t border-gray-200"></div>
                                <div class="px-4 py-2 text-xs text-default/40">{{ __('DropdownActions') }}</div>
                                <a href="#" @click="darkMode = !darkMode" class="flex items-center gap-2 px-4 py-2 hover:bg-default/10" role="menuitem">
                                    <i class="fa-regular" :class="darkMode ? 'fa-moon-stars' : 'fa-sun-bright'"></i> 
                                    <p x-text="darkMode ? '{{ __('DropdownDarkMode') }}' : '{{ __('DropdownLightMode') }}'"></p>
                                </a>
                                <a href="#" class="block px-4 py-2 text-error hover:bg-default/10" role="menuitem"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa-solid fa-arrow-right-start-on-rectangle"></i> {{ __('DropdownLogout') }}
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
                <a class="px-4 py-2 text-white transition-all duration-300 rounded-lg bg-primary hover:bg-opacity-80"
                    href="{{ route('auth.login') }}">{{ __('Login') }}</a>
                @endguest
            </div>
        </div>
    </nav>

    {{-- Mobile --}}
    <div class="fixed bottom-0 left-0 right-0 md:hidden z-[10000]">
        <div class="flex items-end justify-around pb-2 bg-input min-h-[64px]">
            <a href="{{ route('home') }}"
                class="flex flex-col items-center justify-center h-full gap-3 {{ Route::is('home') ? 'text-primary' : 'text-default/40' }}">
                <i class="fa-regular fa-house fa-xl"></i><span class="text-sm">{{ __('NavHome') }}</span>
            </a>
            <a href="{{ route('catalog.acheter') }}"
                class="flex flex-col items-center justify-center h-full gap-3 {{ Route::is('catalog.acheter') ? 'text-primary' : 'text-default/40' }}">
                <i class="fa-regular fa-car-side fa-xl"></i><span class="text-sm">{{ __('NavBuy') }}</span>
            </a>
            <a href="{{ route('catalog.encherir') }}"
                class="flex flex-col items-center justify-center h-full gap-3 {{ Route::is('catalog.encherir') ? 'text-primary' : 'text-default/40' }}">
                <i class="fa-regular fa-building-columns fa-xl"></i><span class="text-sm">{{ __('NavBid') }}</span>
            </a>
            <a href="{{ route('chat.index') }}"
                class="flex flex-col items-center justify-center h-full gap-3 {{ Route::is('chat.index') ? 'text-primary' : 'text-default/40' }}">
                <i class="fa-regular fa-messages fa-xl"></i><span class="text-sm">{{ __('DropdownMessages') }}</span>
            </a>
            @if(auth()->check())
                <a href="{{ route('user.index', ['id' => Auth::id()]) }}"
                    class="flex flex-col items-center justify-center h-full gap-3 {{ Route::is(['user.index', 'user.edit']) ? 'text-primary' : 'text-default/40' }}">
                    <i class="fa-regular fa-user fa-xl"></i><span class="text-sm">{{ __('Profile') }}</span>
                </a>
            @else
                <a href="{{ route('auth.login') }}"
                    class="flex flex-col items-center justify-center h-full gap-3 {{ Route::is('auth.login') ? 'text-primary' : 'text-default/40' }}">
                    <i class="fa-regular fa-user fa-xl"></i><span class="text-sm">{{ __('Profile') }}</span>
                </a>
            @endif
        </div>
    </div>

    <div class="flex-grow flex flex-col {{ request()->is('chat') ? '' : 'md:mx-16 md:my-16'}}">

        @yield('contenu')

    </div>

    {{-- Footer --}}
    <footer class="px-2 py-8 mb-16 md:p-8 md:mb-0 bg-background top-full">
        <div class="flex flex-col gap-4">
            <div class="justify-between hidden md:flex">
                <div class="flex items-center gap-2">
                    <img :src="darkMode ? '{{ asset('assets/logo_automarket_light.png') }}' : '{{ asset('assets/logo_automarket.webp') }}'" alt="Logo" class="h-10 mb-2">
                    <span class="text-base">AutoMarket</span>
                </div>
                <form action="" class="flex h-10">
                    @csrf
                    <input type="email" class="w-48 px-4 py-2 text-xs border rounded-l-lg border-input-border bg-input"
                        placeholder="{{ __("FooterEmail") }}">
                    <button type="submit"
                        class="px-4 py-2 text-xs text-white transition-all duration-300 rounded-r-lg bg-primary hover:bg-opacity-80">{{ __("FooterSubscribe") }}</button>
                </form>
            </div>
            <div class="flex items-center justify-center gap-4 flex-col-default md:flex-row md:justify-between">
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
                    @foreach (config('localization.locales') as $locale => $lang)
                    <a href="{{ route('localization', $locale) }}" class="text-xs text-gray-500 hover:text-gray-700">{{ __($lang) }}</a>
                    @endforeach
                </div>
                <span class="hidden text-xs text-gray-500 md:block">©2024 AutoMarket</span>
            </div>
        </div>
    </footer>
</body>

</html>
