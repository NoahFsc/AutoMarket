<div class="flex flex-col justify-between w-64 py-4 bg-background">
    {{-- Menus --}}
    <div class="flex flex-col mx-4">

        {{-- Logo --}}
        <a href="{{ route('home') }}">
            <div class="flex items-center">
                <img :src="darkMode ? '{{ asset('assets/logo_automarket_light.png') }}' : '{{ asset('assets/logo_automarket.webp') }}'" alt="Logo" class="h-16 mb-2">
                <span class="text-xl font-medium">AutoMarket</span>
            </div>
        </a>

        {{-- Options --}}
        <p class="py-4 text-sm opacity-50">{{ __('Administration') }}</p>

        <div class="flex flex-col gap-2">
            {{-- Utilisateurs --}}
            <a href="{{ route('admin.users-list') }}" class="text-lg flex items-center gap-3 py-2 px-4 font-medium rounded-lg {{ Route::is('admin.users-list') ? 'bg-gray-500 bg-opacity-20 text-default' : 'hover:text-default/80 hover:bg-opacity-20 text-default/50' }}">
                <i class="text-lg fa-users-gear {{ Route::is('admin.users-list') ? 'text-default fa-solid' : 'fa-regular text-default/50' }}"></i>
                {{ __('Users') }}
            </a>
    
            {{-- Annonces --}}
            <a href="{{ route('admin.offers-list') }}" class="text-lg flex items-center gap-3 py-2 px-4 font-medium rounded-lg {{ Route::is('admin.offers-list') ? 'bg-gray-500 bg-opacity-20 text-default' : 'hover:text-default/80 hover:bg-opacity-20 text-default/50' }}">
                <i class="text-lg fa-bullhorn {{ Route::is('admin.offers-list') ? 'fa-solid text-default' : 'fa-regular text-default/50' }}"></i>
                {{ __('Offers') }}
            </a>
    
            {{-- Signalements --}}
            <a href="{{ route('admin.reports-list') }}" class="text-lg flex items-center gap-3 py-2 px-4 font-medium rounded-lg {{ Route::is('admin.reports-list') ? 'bg-gray-500 bg-opacity-20 text-default' : 'hover:text-default/80 hover:bg-opacity-20 text-default/50' }}">
                <i class="text-lg fa-flag {{ Route::is('admin.reports-list') ? 'fa-solid text-default' : 'fa-regular text-default/50' }}"></i>
                {{ __('Reports') }}
            </a>
    
            {{-- Accordéon Référentiels --}}
            {{-- Vérifie si le menu est ouvert : si oui, le garder ouvert en cas de changement de page. Sinon, le garder fermé. --}}
            <div x-data="{ open: localStorage.getItem('referencesMenuOpen') === 'true' || {{ Route::is('admin.references.*') ? 'true' : 'false' }} }" x-init="$watch('open', value => localStorage.setItem('referencesMenuOpen', value))">
                
                {{-- Titre --}}
                <button @click="open = !open" class="flex items-center justify-start w-full gap-3 px-4 py-2 text-lg font-medium rounded-lg" :class="open ? 'text-default' : 'hover:text-default/80 hover:bg-opacity-20 text-default/50'">
                    <i :class="open ? 'fa-chevron-up fa-solid' : 'fa-chevron-down fa-regular'" class="text-lg"></i>
                    {{ __('References') }}
                </button>

                {{-- Contenu --}}
                <div class="flex flex-col gap-2" x-cloak x-show="open" x-collapse>
                    <a href="{{ route('admin.references.brands-list') }}" class="text-lg flex items-center gap-3 py-2 px-8 font-medium rounded-lg {{ Route::is('admin.references.brands-list') ? 'bg-gray-500 bg-opacity-20 text-default' : 'hover:text-default/80 hover:bg-opacity-20 text-default/50' }}">
                        <span class="opacity-50">•</span>
                        <i class="fa-regular fa-car {{ Route::is('admin.references.brands-list') ? 'fa-solid text-default' : 'fa-regular text-default/50' }}"></i>
                        {{ __('Brands') }}
                    </a>
                    <a href="{{ route('admin.references.models-list') }}" class="text-lg flex items-center gap-3 py-2 px-8 font-medium rounded-lg {{ Route::is('admin.references.models-list') ? 'bg-gray-500 bg-opacity-20 text-default' : 'hover:text-default/80 hover:bg-opacity-20 text-default/50' }}">
                        <span class="opacity-50">•</span>
                        <i class="fa-regular fa-tags {{ Route::is('admin.references.models-list') ? 'fa-solid text-default' : 'fa-regular text-default/50' }}"></i>
                        {{ __('Models') }}
                    </a>
                    <a href="{{ route('admin.references.critair-list') }}" class="text-lg flex items-center gap-3 py-2 px-8 font-medium rounded-lg {{ Route::is('admin.references.critair-list') ? 'bg-gray-500 bg-opacity-20 text-default' : 'hover:text-default/80 hover:bg-opacity-20 text-default/50' }}">
                        <span class="opacity-50">•</span>
                        <i class="fa-regular fa-circle-check {{ Route::is('admin.references.critair-list') ? 'fa-solid text-default' : 'fa-regular text-default/50' }}"></i>
                        {{ __('CritAir') }}
                    </a>
                    <a href="{{ route('admin.references.carburants-list') }}" class="text-lg flex items-center gap-3 py-2 px-8 font-medium rounded-lg {{ Route::is('admin.references.carburants-list') ? 'bg-gray-500 bg-opacity-20 text-default' : 'hover:text-default/80 hover:bg-opacity-20 text-default/50' }}">
                        <span class="opacity-50">•</span>
                        <i class="fa-regular fa-gas-pump {{ Route::is('admin.references.carburants-list') ? 'fa-solid text-default' : 'fa-regular text-default/50' }}"></i>
                        {{ __('Fuels') }}
                    </a>
                    <a href="{{ route('admin.references.portieres-list') }}" class="text-lg flex items-center gap-3 py-2 px-8 font-medium rounded-lg {{ Route::is('admin.references.portieres-list') ? 'bg-gray-500 bg-opacity-20 text-default' : 'hover:text-default/80 hover:bg-opacity-20 text-default/50' }}">
                        <span class="opacity-50">•</span>
                        <i class="fa-regular fa-garage {{ Route::is('admin.references.portieres-list') ? 'fa-solid text-default' : 'fa-regular text-default/50' }}"></i>
                        {{ __('Doors') }}
                    </a>
                    <a href="{{ route('admin.references.boites-list') }}" class="text-lg flex items-center gap-3 py-2 px-8 font-medium rounded-lg {{ Route::is('admin.references.boites-list') ? 'bg-gray-500 bg-opacity-20 text-default' : 'hover:text-default/80 hover:bg-opacity-20 text-default/50' }}">
                        <span class="opacity-50">•</span>
                        <i class="fa-regular fa-gears {{ Route::is('admin.references.boites-list') ? 'fa-solid text-default' : 'fa-regular text-default/50' }}"></i>
                        {{ __('Gearboxes') }}
                    </a>
                    <a href="{{ route('admin.references.types-list') }}" class="text-lg flex items-center gap-3 py-2 px-8 font-medium rounded-lg {{ Route::is('admin.references.types-list') ? 'bg-gray-500 bg-opacity-20 text-default' : 'hover:text-default/80 hover:bg-opacity-20 text-default/50' }}">
                        <span class="opacity-50">•</span>
                        <i class="fa-regular fa-shapes {{ Route::is('admin.references.types-list') ? 'fa-solid text-default' : 'fa-regular text-default/50' }}"></i>
                        {{ __('VehicleTypes') }}
                    </a>
                </div>
            </div>
        </div>

    </div>

    {{-- Utilisateur --}}
    <div class="relative inline-block mx-4 text-left" x-data="{ open: false }">

        {{-- Bouton --}}
        <button @click="open = !open" type="button" class="flex items-center justify-between w-full px-4 py-3 rounded-md bg-input hover:bg-input/80">
            <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('assets/default_pfp.png') }}"
                alt="Avatar" class="rounded-full size-12">
            <div class="flex flex-col text-left">
                <span class="font-medium">{{ Auth::user()->fullName() }}</span>
                <span class="text-xs opacity-50">{{ Auth::user()->email }}</span>
            </div>
            <i class="text-xl fa-regular fa-angle-right"></i>
        </button>

        {{-- Dropdown --}}
        <div x-cloak x-show="open" @click.away="open = false" class="absolute bottom-0 z-50 w-56 bg-input rounded-md shadow-lg -right-[105%] ring-1 ring-black ring-opacity-5" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95">
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
</div>