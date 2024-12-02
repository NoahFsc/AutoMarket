@extends('layout')

@section('titre', 'Acheter')

@section('contenu')
<div class="container mx-auto mt-2">
    <div class="flex">
        {{-- Menu de filtre --}}
        <div class="sticky top-0 max-h-screen p-4 overflow-y-auto border-r w-52 border-opacity-20">
            <h3 class="mb-4 text-2xl font-semibold">Filtres</h3>
            <form>
                <div class="mb-4">
                    <label for="annee_min" class="block text-base opacity-50">Année</label>
                    <div class="flex space-x-2">
                        <input type="text" id="annee_min" name="annee_min" placeholder="Min" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm h-9 focus:border-indigo-500 pl-[5px] focus:ring-indigo-500 sm:text-sm">
                        <input type="text" id="annee_max" name="annee_max" placeholder="Max" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm h-9 focus:border-indigo-500 pl-[5px] focus:ring-indigo-500 sm:text-sm">
                    </div>
                </div>
                <div class="mb-4">
                    <label for="kilometrage_min" class="block text-base opacity-50">Kilométrage</label>
                    <div class="flex space-x-2">
                        <input type="text" id="kilometrage_min" name="kilometrage_min" placeholder="Min" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm h-9 focus:border-indigo-500 pl-[5px] focus:ring-indigo-500 sm:text-sm">
                        <input type="text" id="kilometrage_max" name="kilometrage_max" placeholder="Max" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm h-9 focus:border-indigo-500 pl-[5px] focus:ring-indigo-500 sm:text-sm">
                    </div>
                </div>
                <div class="mb-4">
                    <label for="price_min" class="block text-base opacity-50">Prix</label>
                    <div class="flex space-x-2">
                        <input type="text" id="price_min" name="price_min" placeholder="Min" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm h-9 focus:border-indigo-500 pl-[5px] focus:ring-indigo-500 sm:text-sm">
                        <input type="text" id="price_max" name="price_max" placeholder="Max" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm h-9 focus:border-indigo-500 pl-[5px] focus:ring-indigo-500 sm:text-sm">
                    </div>
                </div>
                <div>
                    <label for="carburant" class="block text-base opacity-50">Carburant</label>
                    <div class="flex items-center mb-2">
                        <input type="checkbox" name="diesel" id="diesel" class="mr-2 bg-transparent">
                        <label for="diesel" class="ml-2">Diesel</label>
                    </div>
                    <div class="flex items-center mb-2">
                        <input type="checkbox" name="essence" id="essence" class="mr-2 bg-transparent">
                        <label for="essence" class="ml-2">Essence</label>
                    </div>
                    <div class="flex items-center mb-2">
                        <input type="checkbox" name="electrique" id="electrique" class="mr-2 bg-transparent">
                        <label for="electrique" class="ml-2">Électrique</label>
                    </div>
                    <div class="flex items-center mb-2">
                        <input type="checkbox" name="hybride" id="hybride" class="mr-2 bg-transparent">
                        <label for="hybride" class="ml-2">Hybride</label>
                    </div>
                </div>
                <div>
                    <label for="boite" class="block text-base opacity-50">Boîte</label>
                    <div class="flex items-center mb-2">
                        <input type="checkbox" name="manuelle" id="manuelle" class="mr-2 bg-transparent">
                        <label for="manuelle" class="ml-2">Manuelle</label>
                    </div>
                    <div class="flex items-center mb-2">
                        <input type="checkbox" name="automatique" id="automatique" class="mr-2 bg-transparent">
                        <label for="automatique" class="ml-2">Automatique</label>
                    </div>
                </div>
                <div>
                    <label for="vendeur" class="block text-base opacity-50">Vendeur</label>
                    <div class="flex items-center mb-2">
                        <input type="checkbox" name="non-verifie" id="non-verifie" class="mr-2 bg-transparent">
                        <label for="non-verifie" class="ml-2">Non vérifié</label>
                    </div>
                    <div class="flex items-center mb-2">
                        <input type="checkbox" name="verifie" id="verifie" class="mr-2 bg-transparent">
                        <label for="verifie" class="ml-2">Vérifié</label>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="portes" class="block text-base opacity-50">Portes</label>
                    <div class="flex space-x-2">
                        <input type="text" id="portes" name="portes" placeholder="Entrez un nombre" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm h-9 focus:border-indigo-500 pl-[5px] focus:ring-indigo-500 sm:text-sm">
                    </div>
                </div>
                <div class="mb-4">
                    <label for="sieges" class="block text-base opacity-50">Sièges</label>
                    <div class="flex space-x-2">
                        <input type="text" id="sieges" name="sieges" placeholder="Entrez un nombre" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm h-9 focus:border-indigo-500 pl-[5px] focus:ring-indigo-500 sm:text-sm">
                    </div>
                </div>
                <div x-data="{ open: false }" class="relative mb-4 group" @mouseenter="open = true" @mouseleave="open = false">
                    <label for="type_vehicule" class="block text-base opacity-50 cursor-pointer">Type de véhicule</label>
                    <div x-show="open" class="absolute z-10 hidden p-4 ml-2 bg-white border border-gray-300 rounded-lg shadow-lg left-full group-hover:block">
                        <label for="type_vehicule_search" class="block text-sm font-medium text-gray-700">Rechercher</label>
                        <input type="text" id="type_vehicule_search" name="type_vehicule_search" placeholder="Rechercher" class="block w-full mt-1 mb-2 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <div class="grid grid-cols-2 gap-2">
                            <div class="flex items-center">
                                <input type="checkbox" id="type1" name="type1" class="mr-2">
                                <label for="type1" class="text-sm">Type 1</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" id="type2" name="type2" class="mr-2">
                                <label for="type2" class="text-sm">Type 2</label>
                            </div>
                            <!-- Ajoutez plus de types de véhicules ici -->
                        </div>
                    </div>
                </div>
                <div x-data="{ open: false }" class="relative mb-4 group" @mouseenter="open = true" @mouseleave="open = false">
                    <label for="marque" class="block text-base opacity-50 cursor-pointer">Marque</label>
                    <div x-show="open" class="absolute z-10 hidden p-4 ml-2 bg-white border border-gray-300 rounded-lg shadow-lg left-full group-hover:block">
                        <label for="marque_search" class="block text-sm font-medium text-gray-700">Rechercher</label>
                        <input type="text" id="marque_search" name="marque_search" placeholder="Rechercher" class="block w-full mt-1 mb-2 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <div class="grid grid-cols-2 gap-2">
                            <div class="flex items-center">
                                <input type="checkbox" id="marque1" name="marque1" class="mr-2">
                                <label for="marque1" class="text-sm">Marque 1</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" id="marque2" name="marque2" class="mr-2">
                                <label for="marque2" class="text-sm">Marque 2</label>
                            </div>
                            <!-- Ajoutez plus de marques ici -->
                        </div>
                    </div>
                </div>
                <div x-data="{ open: false }" class="relative mb-4 group" @mouseenter="open = true" @mouseleave="open = false">
                    <label for="modele" class="block text-base opacity-50 cursor-pointer">Modèle</label>
                    <div x-show="open" class="absolute z-10 hidden p-4 ml-2 bg-white border border-gray-300 rounded-lg shadow-lg left-full group-hover:block">
                        <label for="modele_search" class="block text-sm font-medium text-gray-700">Rechercher</label>
                        <input type="text" id="modele_search" name="modele_search" placeholder="Rechercher" class="block w-full mt-1 mb-2 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <div class="grid grid-cols-2 gap-2">
                            <div class="flex items-center">
                                <input type="checkbox" id="modele1" name="modele1" class="mr-2">
                                <label for="modele1" class="text-sm">Modèle 1</label>
                            </div>
                            <div class="flex items-center">
                                <input type="checkbox" id="modele2" name="modele2" class="mr-2">
                                <label for="modele2" class="text-sm">Modèle 2</label>
                            </div>
                            <!-- Ajoutez plus de modèles ici -->
                        </div>
                    </div>
                </div>
            </form>
        </div>

        {{-- Grille des cartes --}}
        <div class="flex flex-col w-full">
            <div class="mb-4" x-show="selectedFilters.length > 0">
                <template x-for="(filter, index) in selectedFilters" :key="index">
                    <div class="inline-flex items-center px-3 py-1 mr-2 text-sm font-medium text-white bg-blue-500 rounded-full">
                        <span x-text="filter.name"></span>
                        <button @click="removeFilter(index)" class="ml-2 text-white hover:text-gray-300">&times;</button>
                    </div>
                </template>
            </div>
            <div class="mb-14">
                <h2 class="text-2xl font-semibold">Véhicules - XXX Annonces</h2>
            </div>
            <div class="flex justify-center w-full mb-4">
                <div class="grid grid-cols-3 gap-4">
                    {{-- Début de la boucle de création des cartes --}}
                    @for ($i = 0; $i < 12;$i++)
                        <div class="overflow-hidden transition-transform transform rounded-lg shadow-md hover:scale-105" style="width: 330px; height: 270px;">
                            <img src="https://images.caradisiac.com/logos/3/9/2/7/283927/S8-tesla-model-y-alors-fiable-en-occasion-ou-pas-210209.jpg" alt="Image" class="object-cover" style="width: 330px; height: 200px;">
                            <div class="p-2" style="width: 330px;">
                                <h2 class="text-lg font-semibold">Tesla Model Y</h2>
                                <div class="flex justify-between mt-1 text-gray-600">
                                    <p class="text-sm">John Doe</p>
                                    <p class="text-lg font-medium">37.850€</p>
                                </div>
                            </div>
                        </div>
                    @endfor
                {{-- Fin de la boucle de création des cartes --}}
            </div>
        </div>
    </div>
</div>

<script>
    function filterData() {
        return {
            selectedFilters: [],
            toggleFilter(category, name, isChecked) {
                if (isChecked) {
                    this.selectedFilters.push({ category, name });
                } else {
                    this.selectedFilters = this.selectedFilters.filter(filter => filter.name !== name);
                }
            },
            removeFilter(index) {
                this.selectedFilters.splice(index, 1);
            }
        }
    }
</script>
@endsection

    {{-- pagination
    <div class="mt-4">
        {{ $cards->links() }}
    </div>
    --}}