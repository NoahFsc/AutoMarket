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
    <select name="brand" class="border px-4 py-2 rounded-l">
      <option value="">Marque</option>
      <option value="Renault">Renault</option>
      <option value="Peugeot">Peugeot</option>
    </select>
    <select name="model" class="border-t border-b border-r px-4 py-2">
      <option value="">Modèle</option>
      <option value="Twingo">Twingo</option>
      <option value="Clio">Clio</option>
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
  <section class="categories py-8 mx-auto">
    <h2 class="text-2xl font-bold mb-4">Catégories populaires</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach ($cars->take(6) as $car)
      <div class="bg-gray-100 rounded-lg shadow-md position-transform transform hover:squale 105"
        style="max-width: 310px; width: 100%;">
        @if ($car->imageDocument)
        <img src="{{ $car->imageDocument->document_content }}" alt="{{ $car->carModel->model_name }}"
          class="w-[310px] h-[210px] object-cover mx-auto rounded-t-lg" />
        @endif
        <div class="p-4">
          <h3 class="font-bold text-lg">{{ $car->brand }} {{ $car->carModel->model_name }}</h3>
          <p class="text-gray-600">Vendu par {{ $car->user->first_name . ' ' . $car->user->last_name }}</p>
          <p class="text-lg font-bold mt-2">{{ $car->selling_price }}€</p>
        </div>
      </div>
      @endforeach
    </div>
  </section>

  <!-- Enchères en cours -->
  <section class="categories py-8">
    <h2 class="text-2xl font-bold mb-4">Enchères en cours</h2>
    <div class="flex flex-wrap gap-4 overflow-x-auto">
      @foreach ($cars->take(3) as $car)
      <div class="card bg-gray-100 p-4 rounded shadow w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/6">
        @if ($car->imageDocument)
        <img src="{{ $car->imageDocument->document_content }}" alt="{{ $car->carModel->model_name }}"
          class="rounded w-full" style="width: 310px; height: 200px; object-fit: cover;" />
        @endif
        <h3 class="font-bold mt-4">{{ $car->brand }} {{ $car->model }}</h3>
        <p class="text-gray-600">Fin dans {{ $car->user->name }}</p>
        <p class="text-lg font-bold mt-2">{{ \Carbon\Carbon::parse($car->deadline)->diffForHumans(\Carbon\Carbon::now(),
          ['parts' => 2]); }}</p>
        <p class="text-gray-600">Vendu par {{ $car->user->first_name . $car->user->last_name }}</p>
        <p class="text-lg font-bold mt-2">{{ $car->selling_price }}€</p>
      </div>
      @endforeach
    </div>
  </section>

  <!-- Avis -->
  <section class="testimonials py-8">
    <h2 class="text-2xl font-bold mb-4">Ce que nos clients disent de nous...</h2>
    <div class="flex gap-4 overflow-x-auto">

    </div>
  </section>
</div>
</div>

@endsection