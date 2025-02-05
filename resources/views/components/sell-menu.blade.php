<div>
    <div class="flex items-center justify-end mb-2">
        <div class="relative w-full md:w-1/3">
            <i
                class="absolute text-gray-500 transform -translate-y-1/2 fa-light fa-magnifying-glass left-3 top-1/2"></i>
            <input type="text" wire:model.live='search' placeholder="Rechercher une annonce"
                class="block w-full h-10 py-2 pl-10 pr-4 border-gray-300 rounded-md sm:text-sm">
        </div>
        <button wire:click="createAd"
            class="flex items-center justify-center w-full h-10 px-4 py-2 ml-4 border-4 rounded-lg md:w-auto border-secondary bg-secondary">
            <i class="mr-2 fa-light fa-plus"></i> Créer une annonce
        </button>
    </div>

    <!-- Vos ventes en cours -->
    <section class="py-8 mx-auto">
        <div class="flex justify-between">
            <h2 class="mb-4 text-2xl font-medium">
                Vos ventes en cours -
                <span class="text-primary">{{ $sells->count() }} annonces</span>
            </h2>
        </div>
        <div class="grid grid-flow-col gap-6 overflow-hidden select-none auto-cols-max cursor-grab"
            id="sells-container">
            @foreach ($sells as $car)
            @livewire('selling-card', ['car' => $car], key($car->id))
            @endforeach
        </div>
    </section>
    <hr class="border-gray-300">

    <!-- Vos enchères en cours -->
    <section class="py-8 mx-auto">
        <div class="flex justify-between">
            <h2 class="mb-4 text-2xl font-medium">Vos enchères en cours - <span class="text-primary">{{
                    $auctions->count() }} annonces</span></h2>
        </div>
        <div class="grid gap-6 grid-cols-auto-fit-card">
            @foreach ($auctions as $car)
            @livewire('auction-card', ['car' => $car], key($car->id))
            @endforeach
        </div>
    </section>
</div>

<script>
    const container = document.getElementById('sells-container');
    const cards = document.querySelectorAll('.auction-card-container');

    let isDown = false;
    let startX;
    let scrollLeft;

    function handleMouseDown(e) {
        isDown = true;
        container.classList.add('cursor-grabbing');
        startX = e.pageX - container.offsetLeft;
        scrollLeft = container.scrollLeft;
    }

    function handleMouseLeave() {
        isDown = false;
        container.classList.remove('cursor-grabbing');
    }

    function handleMouseUp() {
        isDown = false;
        container.classList.remove('cursor-grabbing');
    }

    function handleMouseMove(e) {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - container.offsetLeft;
        const walk = (x - startX) * 1.5; // La vitesse du défilement
        container.scrollLeft = scrollLeft - walk;
    }

    container.addEventListener('mousedown', handleMouseDown);
    container.addEventListener('mouseleave', handleMouseLeave);
    container.addEventListener('mouseup', handleMouseUp);
    container.addEventListener('mousemove', handleMouseMove);

    cards.forEach(card => {
        card.addEventListener('mousedown', handleMouseDown);
        card.addEventListener('mouseup', handleMouseUp);
        card.addEventListener('mousemove', handleMouseMove);
    });
</script>