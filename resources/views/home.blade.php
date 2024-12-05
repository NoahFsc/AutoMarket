@extends('layout')

@section('titre', 'Accueil')

@section('contenu')

<div class="md:w-2/3 md:mx-auto mx-8">
  <!-- Bienvenue -->
  <div class="mx-auto md:mb-16">
    <h1 class="text-6xl font-medium">Votre nouvelle voiture, sans intermédiaire.</h1>
    <p class="text-xl mt-4 text-gray-700">
      Explorez des centaines d'offres de particuliers à particuliers, et trouvez le véhicule qui vous correspond, en
      toute
      simplicité.
    </p>
  </div>

  <!-- Search Form -->
  <livewire:home-search />

  <!-- Stats -->
  <section class="stats flex flex-col md:flex-row justify-around py-8 gap-4 md:gap-0 md:mt-32">
    <div class="flex flex-col md:flex-row items-center gap-2">
      <h2 class="text-3xl font-bold mr-4">5.000+</h2>
      <p>Véhicules mis en vente tous les mois</p>
    </div>
    <div class="flex flex-col md:flex-row items-center gap-2">
      <h2 class="text-3xl font-bold mr-4">98%</h2>
      <p>Satisfaction de nos clients</p>
    </div>
    <div class="flex flex-col md:flex-row items-center gap-2">
      <h2 class="text-3xl font-bold mr-4">4.3</h2>
      <p>Note moyenne sur 5 de nos services</p>
    </div>
  </section>

  <!-- Popular Categories -->
  <section class="py-8 mx-auto md:mt-32">
    <div class="flex justify-between">
      <h2 class="text-2xl font-bold mb-4">Catégories populaires</h2>
      <a href="{{ route('home') }}" class="hidden md:block">Voir tout</a>
    </div>
    <div class="grid grid-cols-auto-fit-card gap-6">
      @foreach ($sells->take(8) as $car)
      @livewire('selling-card', ['car' => $car])
      @endforeach
    </div>
  </section>

  <!-- Enchères en cours -->
  <section class="py-8 mx-auto md:mt-16">
    <div class="flex justify-between">
      <h2 class="text-2xl font-bold mb-4">Enchères en cours</h2>
      <a href="{{ route('home') }}" class="hidden md:block">Voir tout</a>
    </div>
    <div class="grid grid-cols-auto-fit-card gap-6">
      @foreach ($auctions->take(4) as $car)
      @livewire('auction-card', ['car' => $car])
      @endforeach
    </div>
  </section>

  <!-- Avis -->
  <section class="py-8 mx-auto md:mt-16">
    <h2 class="text-2xl font-bold mb-4">Ce que nos clients disent de nous...</h2>
    <div class="grid grid-cols-auto-fit-card gap-6">
      @foreach ($review->take(4) as $review)
      @livewire('review-card', ['review' => $review])
      @endforeach
    </div>
  </section>
</div>
</div>

@endsection