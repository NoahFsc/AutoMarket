@extends('layout')

@section('titre', 'Acheter')

@section('contenu')
<div class="container mx-auto mt-2">
    <div class="flex">
        {{-- Menu de filtre --}}
        <div class="fixed left-0 p-4" style="width: 200px;">
            <h3 class="mb-4 text-lg font-semibold">Filtres</h3>
            <form>
                <div class="mb-4">
                    <label for="kilometrage_min" class="block text-base opacity-50">Kilométrage</label>
                    <div class="flex space-x-2">
                        <input type="text" id="kilometrage_min" name="kilometrage_min" placeholder="Min" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <input type="text" id="kilometrage_max" name="kilometrage_max" placeholder="Max" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>
                </div>
                <div class="mb-4">
                    <label for="price_min" class="block text-base opacity-50">Prix</label>
                    <div class="flex space-x-2">
                        <input type="text" id="price_min" name="price_min" placeholder="Min" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <input type="text" id="price_max" name="price_max" placeholder="Max" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>
                </div>
            </form>
        </div>

        {{-- Grille des cartes --}}
        <div class="flex justify-center w-full ml-52">
            <div class="grid grid-cols-3 gap-4">
                {{-- Début de la boucle de création des cartes --}}
                @foreach ($cards as $card)
                    <div class="overflow-hidden rounded-lg " style="width: 330px; height: 270px;">
                        <img src="{{ $card['image'] }}" alt="Image" class="object-cover" style="width: 330px; height: 200px;">
                        <div class="p-2" style="width: 330px;">
                            <h2 class="text-lg font-semibold">{{ $card['name'] }}</h2>
                            <div class="flex justify-between mt-1 text-gray-600">
                                <p class="text-sm">{{ $card['seller'] }}</p>
                                <p class="text-lg font-medium">{{ $card['price'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{-- Fin de la boucle de création des cartes --}}
            </div>
        </div>
    </div>

    {{-- pagination
    <div class="mt-4">
        {{ $cards->links() }}
    </div>
    --}}
</div>
@endsection