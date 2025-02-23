<div>
    <div class="flex items-center justify-end mb-2">
        <div class="relative w-full md:w-1/3">
            <i class="absolute transform -translate-y-1/2 text-default/50 fa-regular fa-magnifying-glass left-3 top-1/2"></i>
            <input type="text" wire:model.live='search' placeholder="{{ __('SearchAd') }}"
                class="block w-full h-10 py-2 pl-10 pr-4 rounded-md border-input-border bg-input sm:text-sm">
        </div>
        <button wire:click="createAd"
            class="flex items-center justify-center w-full h-10 px-4 py-2 ml-4 border-4 rounded-lg md:w-auto border-primary bg-primary">
            <i class="mr-2 fa-light fa-plus"></i> {{ __('CreateAd') }}
        </button>
    </div>

    <!-- Vos ventes en cours -->
    <section class="py-8 mx-auto">
        <div class="flex justify-between">
            <h2 class="mb-4 text-2xl font-medium">
                {{ __('YourCurrentSales') }} -
                <span class="text-primary">{{ $sells->count() }} {{ __('Ads') }}</span>
            </h2>
        </div>
        <div class="grid grid-flow-col gap-6 overflow-hidden select-none auto-cols-max cursor-grab"
            id="sells-container">
            @foreach ($sells as $car)
            @livewire('selling-card', ['car' => $car], key($car->id))
            @endforeach
        </div>
    </section>
    <hr class="border-input-border">

    <!-- Vos enchères en cours -->
    <section class="py-8 mx-auto">
        <div class="flex justify-between">
            <h2 class="mb-4 text-2xl font-medium">{{ __('YourCurrentAuctions') }} - <span class="text-primary">{{ $auctions->count() }} {{ __('Ads') }}</span></h2>
        </div>
        <div class="grid grid-flow-col gap-6 overflow-hidden select-none auto-cols-max cursor-grab"
        id="sells-container">
            @foreach ($auctions as $car)
            @livewire('auction-card', ['car' => $car], key($car->id))
            @endforeach
        </div>
    </section>
</div>

<script>
    // Appliquer le comportement sur toutes les listes (ventes et enchères)
    const containers = document.querySelectorAll('.grid-flow-col');

    containers.forEach(container => {
        let isDown = false;
        let startX;
        let scrollLeft;

        // Gestion du drag avec la souris
        container.addEventListener('mousedown', (e) => {
            isDown = true;
            container.classList.add('cursor-grabbing');
            startX = e.pageX - container.offsetLeft;
            scrollLeft = container.scrollLeft;
        });

        container.addEventListener('mouseleave', () => {
            isDown = false;
            container.classList.remove('cursor-grabbing');
        });

        container.addEventListener('mouseup', () => {
            isDown = false;
            container.classList.remove('cursor-grabbing');
        });

        container.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - container.offsetLeft;
            const walk = (x - startX) * 1.5; // Ajuste la vitesse du déplacement
            container.scrollLeft = scrollLeft - walk;
        });

        // Ajout du scroll horizontal avec la molette
        container.addEventListener('wheel', (e) => {
            e.preventDefault(); // Empêche le scroll vertical
            container.scrollLeft += e.deltaY * 2; // Multiplier pour ajuster la vitesse
        });
    });
</script>