<div class="flex flex-col justify-between w-56 border-r-2 border-r-gray-300">
    <div class="flex flex-col">
        <p class="py-4 mx-auto text-xl font-medium">Administration</p>
        <a href="{{ route('admin.users-list') }}" class="text-lg flex items-center gap-3 py-4 px-12 {{ Route::is('admin.users-list') ? 'bg-primary-500 bg-opacity-20' : 'hover:bg-primary-300 hover:bg-opacity-20' }}">
            <i class="text-lg fa-regular fa-users-gear"></i>
            Utilisateurs
        </a>
        <a href="{{ route('admin.offers-list') }}" class="text-lg flex items-center gap-3 py-4 px-12 {{ Route::is('admin.offers-list') ? 'bg-primary-500 bg-opacity-20' : 'hover:bg-primary-300 hover:bg-opacity-20' }}">
            <i class="text-lg fa-regular fa-bullhorn"></i>
            Annonces
        </a>
        <a href="{{ route('admin.reports-list') }}" class="text-lg flex items-center gap-3 py-4 px-12 {{ Route::is('admin.reports-list') ? 'bg-primary-500 bg-opacity-20' : 'hover:bg-primary-300 hover:bg-opacity-20' }}">
            <i class="text-lg fa-regular fa-flag"></i>
            Signalements
        </a>

        {{-- Accordéon Référentiels --}}
        <div x-data="{ open: false }">
            <button @click="open = !open" class="text-lg flex items-center gap-3 py-4 px-12 w-full text-left focus:outline-none {{ Route::is('admin.references.*') ? 'bg-primary-500 bg-opacity-20' : 'hover:bg-primary-300 hover:bg-opacity-20' }}">
                <i class="text-lg fa-regular fa-folder-open"></i>
                Référentiels
                <i :class="open ? 'fa-chevron-up' : 'fa-chevron-down'" class="ml-auto fa-regular"></i>
            </button>
            <div x-show="open" x-collapse>
                <a href="{{ route('admin.references.brands-list') }}" class="text-lg flex items-center gap-3 py-4 px-12 pl-16 {{ Route::is('admin.references.critair') ? 'bg-primary-500 bg-opacity-20' : 'hover:bg-primary-300 hover:bg-opacity-20' }}">
                    <i class="fa-regular fa-cars"></i>
                    Marques
                </a>
                <a href="{{ route('admin.references.models-list') }}" class="text-lg flex items-center gap-3 py-4 px-12 pl-16 {{ Route::is('admin.references.critair') ? 'bg-primary-500 bg-opacity-20' : 'hover:bg-primary-300 hover:bg-opacity-20' }}">
                    <i class="fa-regular fa-tags"></i>
                    Modèles
                </a>
                <a href="{{ route('admin.references.critair-list') }}" class="text-lg flex items-center gap-3 py-4 px-12 pl-16 {{ Route::is('admin.references.critair') ? 'bg-primary-500 bg-opacity-20' : 'hover:bg-primary-300 hover:bg-opacity-20' }}">
                    <i class="fa-regular fa-circle-check"></i>
                    Crit'air
                </a>
            </div>
        </div>
    </div>
    <form class="w-9/12 mx-auto" method="POST" action="{{ route('auth.logout') }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="w-full py-2 transition-all duration-300 border-2 rounded-lg text-error-600 border-opacity-20 hover:border-opacity-80 border-error-500">
            Se déconnecter
        </button>
    </form>
</div>
