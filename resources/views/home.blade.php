@extends('layout')

@section('titre', 'Accueil')

@section('contenu')

<div class="container mx-auto px-4">
    @auth
    <h1 class="text-4xl font-bold">Bienvenue <b>{{ Auth::user()->name }}</b> 👋,</h1>
    <p class="w-1/2 mt-4">
        Nous sommes ravis de vous accueillir sur AutoMarket.
    </p>
    @endauth

    @guest
    <h1 class="text-4xl font-bold">Votre nouvelle voiture, sans intermédiaire.</h1>
    <p class="text-lg mt-4">
      Explorez des centaines d'offres de particuliers à particuliers, et trouvez le véhicule qui vous correspond, en toute simplicité.
    </p>
    @endguest
</div>

  <!-- Search Form -->
  <form class="mt-8 flex justify-center items-center gap-4">
      <select name="brand" class="border px-4 py-2 rounded">
        <option value="">Marque</option>
        <option value="Renault">Renault</option>
        <option value="Peugeot">Peugeot</option>
      </select>
      <select name="model" class="border px-4 py-2 rounded">
        <option value="">Modèle</option>
        <option value="Twingo">Twingo</option>
        <option value="Clio">Clio</option>
      </select>
      <input type="number" placeholder="Kilométrage max" class="border px-4 py-2 rounded" />
      <input type="text" placeholder="Code Postal" class="border px-4 py-2 rounded" />
      <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Parcourir</button>
    </form>
  </section>

  <!-- Stats -->
  <section class="stats flex justify-around py-8 border-t">
    <div class="text-center">
      <h2 class="text-3xl font-bold">5.000+</h2>
      <p>Véhicules mis en vente tous les mois</p>
    </div>
    <div class="text-center">
      <h2 class="text-3xl font-bold">98%</h2>
      <p>Satisfaction de nos clients</p>
    </div>
    <div class="text-center">
      <h2 class="text-3xl font-bold">4.3</h2>
      <p>Note moyenne sur 5 de nos services</p>
    </div>
  </section>

    <!-- Popular Categories -->
    <section class="categories py-8">
        <h2 class="text-2xl font-bold mb-4">Catégories populaires</h2>
        <div class="flex gap-4 overflow-x-auto">
        @foreach ($cars->take(6) as $car)
        <div class="card bg-gray-100 p-4 rounded shadow w-64">
            <img src="{{ $car->image_url }}" alt="{{ $car->model }}" class="rounded" />
            <h3 class="font-bold mt-4">{{ $car->brand }} {{ $car->model }}</h3>
            <p class="text-gray-600">Vendu par {{ $car->seller }}</p>
            <p class="text-lg font-bold mt-2">{{ $car->price }}€</p>
        </div>
        @endforeach
        </div>
    </section>

    <!-- Enchères en cours -->
    <section class="auctions py-8">
        <h2 class="text-2xl font-bold mb-4">Enchères en cours</h2>
        <div class="flex gap-4 overflow-x-auto">
        @foreach ($auctions->take(3) as $auction)
        <div class="card bg-gray-100 p-4 rounded shadow w-64">
            <img src="{{ $auction->car->image_url }}" alt="{{ $auction->car->model }}" class="rounded" />
            <h3 class="font-bold mt-4">{{ $auction->car->brand }} {{ $auction->car->model }}</h3>
            <p class="text-gray-600">Vendu par {{ $auction->car->seller }}</p>
            <p class="text-lg font-bold mt-2">{{ $auction->car->price }}€</p>
            <p class="text-red-500">Fin dans 17:08:15</p>
        </div>
        @endforeach
        </div>
    </section>

    <!-- Avis -->
    <section class="testimonials py-8">
        <h2 class="text-2xl font-bold mb-4">Ce que nos clients disent de nous...</h2>
        <div class="flex gap-4 overflow-x-auto">
        @foreach ($testimonials->take(3) as $testimonial)
            <div class="card bg-gray-100 p-4 rounded shadow w-64">
                <p class="italic">"{{ $testimonial->content }}"</p>
                <p class="font-bold mt-2">- {{ $testimonial->author }}</p>
            </div>
        @endforeach
        </div>
    </section>
</div>

@endsection