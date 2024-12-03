@extends('layout')

@section('titre', 'Accueil')

@section('contenu')

<div class="w-2/3 mx-auto">
  <!-- Bienvenue -->
  <div class="mx-auto">
    <h1 class="text-4xl font-bold">Votre nouvelle voiture, sans intermédiaire.</h1>
    <p class="text-lg mt-4">
      Explorez des centaines d'offres de particuliers à particuliers, et trouvez le véhicule qui vous correspond, en
      toute
      simplicité.
    </p>
  </div>

  <!-- Search Form -->
  <form class="mt-8 flex justify-center items-center">
    <select name="brand" id="brand" class="border px-4 py-2 rounded-l">
      <option value="">Marque</option>
      @foreach ($brands as $brand)
      <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
      @endforeach
    </select>
    <select name="carModel" id="carModel" class="border px-4 py-2">
      <option value="">Modèle</option>
      @foreach ($carModels as $carModel)
      <option value="{{ $carModel->id }}">{{ $carModel->model_name }}</option>
      @endforeach
    </select>
    <input type="number" placeholder="Kilométrage max" class="border-t border-b border-r px-4 py-2" />
    <input type="text" placeholder="Code Postal" class="border-t border-b border-r px-4 py-2" />
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r">Parcourir</button>
  </form>

  <!-- Stats -->
  <section class="stats flex justify-around py-8">
    <div class="flex items-center space-x-2">
      <h2 class="text-3xl font-bold mr-4">5.000+</h2>
      <p>Véhicules mis en vente tous les mois</p>
    </div>
    <div class="flex items-center space-x-2">
      <h2 class="text-3xl font-bold mr-4">98%</h2>
      <p>Satisfaction de nos clients</p>
    </div>
    <div class="flex items-center space-x-2">
      <h2 class="text-3xl font-bold mr-4">4.3</h2>
      <p>Note moyenne sur 5 de nos services</p>
    </div>
  </section>

  <!-- Popular Categories -->
  <section class="py-8 mx-auto">
    <h2 class="text-2xl font-bold mb-4">Catégories populaires</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach ($cars->take(6) as $car)
      @livewire('selling-card', ['car' => $car])
      @endforeach
    </div>
  </section>

  <!-- Enchères en cours -->
  <section class="py-8">
    <h2 class="text-2xl font-bold mb-4">Enchères en cours</h2>
    <div class="flex gap-4">
      @foreach ($cars->take(3) as $car)
      @livewire('auction-card', ['car' => $car])
      @endforeach
    </div>
  </section>

  <!-- Avis -->
  <section class="py-8">
    <h2 class="text-2xl font-bold mb-4">Ce que nos clients disent de nous...</h2>
    <div class="flex gap-4 flex-start">
      @foreach ($review->take(3) as $review)
      @livewire('review-card', ['review' => $review])
      @endforeach
    </div>
  </section>
</div>
</div>

@endsection