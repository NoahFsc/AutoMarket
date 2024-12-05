<div>
    <!-- Vos ventes en cours -->
    <section class="py-8 mx-auto md:mt-32">
        <div class="flex justify-between">
            <h2 class="text-2xl font-bold mb-4">Vos ventes en cours</h2>
        </div>
        <div class="grid grid-cols-auto-fit-card gap-6">
            @foreach ($sells as $car)
            @livewire('selling-card', ['car' => $car])
            @endforeach
        </div>
    </section>

    <!-- Vos enchères en cours -->
    <section class="py-8 mx-auto md:mt-16">
        <div class="flex justify-between">
            <h2 class="text-2xl font-bold mb-4">Vos enchères en cours</h2>
        </div>
        <div class="grid grid-cols-auto-fit-card gap-6">
            @foreach ($auctions as $car)
            @livewire('auction-card', ['car' => $car])
            @endforeach
        </div>
    </section>
</div>