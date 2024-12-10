<div class="flex flex-col justify-between w-56 border-r-2 border-r-gray-300">
    <div class="flex flex-col">
        <p class="py-4 mx-auto text-xl font-medium">Administration</p>
        <a href="{{ route('admin.dashboard') }}" class="text-lg flex items-center gap-3 py-4 px-12 {{ Route::is('admin.dashboard') ? 'bg-primary-500 bg-opacity-20' : '' }}">
            <i class="text-lg fa-solid fa-chart-mixed"></i>
            Dashboard
        </a>
        <a href="{{ route('admin.users.index') }}" class="text-lg flex items-center gap-3 py-4 px-12 {{ Route::is('admin.users.index') ? 'bg-primary-500 bg-opacity-20' : '' }}">
            <i class="text-lg fa-solid fa-users-gear"></i>
            Utilisateurs
        </a>
        <a href="{{ route('admin.offers.index') }}" class="text-lg flex items-center gap-3 py-4 px-12 {{ Route::is('admin.offers.index') ? 'bg-primary-500 bg-opacity-20' : '' }}">
            <i class="text-lg fa-solid fa-bullhorn"></i>
            Annonces
        </a>
        <a href="{{ route('admin.reports.index') }}" class="text-lg flex items-center gap-3 py-4 px-12 {{ Route::is('admin.reports.index') ? 'bg-primary-500 bg-opacity-20' : '' }}">
            <i class="text-lg fa-solid fa-flag"></i>
            Signalements
        </a>
        <a href="{{ route('admin.references.index') }}" class="text-lg flex items-center gap-3 py-4 px-12 {{ Route::is('admin.references.index') ? 'bg-primary-500 bg-opacity-20' : '' }}">
            <i class="text-lg fa-solid fa-book"></i>
            Référentiels
        </a>
    </div>
    <form class="w-full" method="POST" action="{{ route('auth.logout') }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="w-full gap-3 py-2 text-lg transition-all duration-300 border-2 rounded-lg text-error-600 border-opacity-20 hover:border-opacity-80 border-error-500">
            Se déconnecter
        </button>
    </form>
</div>
