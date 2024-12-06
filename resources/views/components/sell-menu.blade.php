<div>
    <div class="flex justify-end items-center mb-2">
        <div class="relative w-full md:w-1/3">
            <i
                class="fa-light fa-magnifying-glass text-gray-500 absolute left-3 top-1/2 transform -translate-y-1/2"></i>
            <input type="text" wire:model.live='search' placeholder="Rechercher une annonce"
                class="block w-full pl-10 pr-4 py-2 border-gray-300 rounded-md sm:text-sm h-10">
        </div>
        <button wire:click="createAd"
            class="w-full md:w-auto px-4 py-2 border-4 rounded-lg border-secondary-400 bg-secondary-400 flex items-center justify-center ml-4 h-10">
            <i class="fa-light fa-plus mr-2"></i> Créer une annonce
        </button>
    </div>

    <!-- Vos ventes en cours -->
    <section class="py-8 mx-auto">
        <div class="flex justify-between">
            <h2 class="text-2xl font-medium mb-4">
                Vos ventes en cours -
                <span class="text-primary-500">{{ $sells->count() }} annonces</span>
            </h2>
        </div>
        <div class="grid grid-flow-col auto-cols-max gap-6 overflow-hidden cursor-grab select-none"
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
            <h2 class="text-2xl font-medium mb-4">Vos enchères en cours - <span class="text-primary-500">{{
                    $auctions->count() }} annonces</span></h2>
        </div>
        <div class="grid grid-cols-auto-fit-card gap-6">
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