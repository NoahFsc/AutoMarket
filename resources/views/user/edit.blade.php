@extends('layout')

@section('titre', 'Edition Profil')

@section('contenu')

<div class="flex flex-col gap-3 mx-8 md:w-1/3 md:mx-auto">

    {{-- Entête --}}
    <form action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data" class="flex flex-col">
        @csrf
        
        <div class="relative flex items-center justify-between w-full">
            <a href="{{ route('user.index') }}" class="absolute left-0 text-sm text-gray-400 hover:text-gray-500">
                <i class="fa-solid fa-chevron-left"></i> Retour
            </a>
    
            <span class="mx-auto font-medium">Edition</span>
        
            <button type="submit" class="absolute right-0 font-medium text-primary-500">Enregistrer</button>
        </div>

        <div class="flex flex-col items-center gap-4 mt-8">
            <div class="relative">
                <img id="imageProfil" src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('assets/default_pfp.png') }}" alt="Avatar" class="rounded-full size-20">
                <button type="button" class="absolute flex items-center justify-center size-8" style="bottom: -5px; right: -5px;">
                    <span class="fa-stack fa-1x">
                        <i class="fa fa-circle fa-stack-2x text-primary-500"></i>
                        <i class="fa-regular fa-pen fa-stack-1x fa-inverse"></i>
                    </span>
                </button>
                <input type="file" name="profile_picture" class="hidden" id="profile_picture">
            </div>
            <div class="flex flex-col items-center">                
                <span class="text-2xl font-bold md:text-4xl">{{Auth::user()->first_name . ' ' . Auth::user()->last_name }}</span>
                <span class="text-base text-gray-500">{{ '@' . strtolower(Auth::user()->first_name . Auth::user()->last_name) }} </span>
            </div>
        </div>

        <div class="flex flex-wrap px-1 py-1 mt-4 bg-gray-200 rounded-lg tab-section">
            <button type="button" class="flex-grow p-1 font-medium text-gray-700 rounded-lg" data-tab-target="#tab1">Profil</button>
            <button type="button" class="flex-grow p-1 font-medium text-gray-700 rounded-lg" data-tab-target="#tab2">Compte</button>
            <button type="button" class="flex-grow p-1 font-medium text-gray-700 rounded-lg" data-tab-target="#tab3">Préferences</button>
        </div>

        {{-- Menu Profil --}}
        <div id="tab1" class="hidden mt-4 tab-content">
            <div class="flex flex-col gap-4">
                <div class="flex flex-col">
                    <label for="first_name" class="mb-1 text-gray-500">Prénom</label>
                    <input type="text" name="first_name" id="first_name" class="w-full px-3 py-2 text-sm border border-gray-200 rounded-md focus:outline-none" placeholder="Entrez votre prénom" value="{{ Auth::user()->first_name }}">
                    @error('first_name')
                        <div class="text-sm text-error-500">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="flex flex-col">
                    <label for="last_name" class="mb-1 text-gray-500">Nom</label>
                    <input type="text" name="last_name" id="last_name" class="w-full px-3 py-2 text-sm border border-gray-200 rounded-md focus:outline-none" placeholder="Entrez votre nom" value="{{ Auth::user()->last_name }}">
                    @error('last_name')
                        <div class="text-sm text-error-500">{{ $message }}</div>
                    @enderror
                </div>
        
                <div class="flex flex-col">
                    <label for="description" class="mb-1 text-gray-500">A propos de moi</label>
                    <textarea name="description" id="description" rows="5" class="w-full px-3 py-2 text-sm border border-gray-200 rounded-md focus:outline-none" placeholder="Entrez une description" value="{{ Auth::user()->description }}"></textarea>
                    @error('description')
                        <div class="text-sm text-error-500">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Menu Compte --}}
        <div id="tab2" class="hidden mt-4 mb-24 tab-content">
            <div class="flex flex-col gap-4">
                <div class="flex flex-col">
                    <label for="email" class="mb-1 text-gray-500">Adresse e-mail</label>
                    <input type="email" name="email" id="email" class="w-full px-3 py-2 text-sm border border-gray-200 rounded-md focus:outline-none" placeholder="Entrez votre adresse e-mail" value="{{ Auth::user()->email }}">
                    @error('email')
                        <div class="text-sm text-error-500">{{ $message }}</div>
                    @enderror
                </div>
        
                <div class="flex flex-col gap-2">
                    <div class="flex flex-col">
                        <label for="current_password" class="mb-1 text-gray-500">Mot de passe (marche pas pr le mmt)</label>
                        <input type="password" name="current_password" id="current_password" class="w-full px-3 py-2 text-sm border border-gray-200 rounded-md focus:outline-none" placeholder="Entrez votre mot de passe actuel">
                        @error('current_password')
                            <div class="text-sm text-error-500">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <div class="flex gap-2">
                        <div class="flex flex-col">
                            <input type="password" name="new_password" id="new_password" class="w-full px-3 py-2 text-sm border border-gray-200 rounded-md focus:outline-none" placeholder="Nouveau mot de passe">
                            @error('new_password')
                                <div class="text-sm text-error-500">{{ $message }}</div>
                            @enderror
                        </div>
                
                        <div class="flex flex-col">
                            <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="w-full px-3 py-2 text-sm border border-gray-200 rounded-md focus:outline-none" placeholder="Confirmez le nouveau mot de passe">
                            @error('new_password_confirmation')
                                <div class="text-sm text-error-500">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
            
                    <form action="{{ route('user.updatePassword') }}" method="POST">
                        @csrf
                        <button type="button" class="w-full px-3 py-2 text-sm text-white rounded-md bg-primary-500 focus:outline-none">Modifier le mot de passe</button>
                    </form>
                </div>
        
                <div class="flex flex-col">
                    <span class="mb-2 text-gray-500">Informations supplémentaires</span>
                    <div class="flex gap-4">
                        <div class="flex flex-col w-1/2">
                            <label for="birth_date" class="mb-1 text-sm text-gray-500">Date de naissance</label>
                            <input type="date" name="birth_date" id="birth_date" class="w-full px-3 py-2 text-sm border border-gray-200 rounded-md focus:outline-none" value="{{ \Carbon\Carbon::parse(Auth::user()->birth_date)->format('Y-m-d') }}">
                            @error('birth_date')
                                <div class="text-sm text-error-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="flex flex-col w-1/2">
                            <label for="identity_card" class="mb-1 text-sm text-gray-500">Carte d'identité</label>
                            <input type="file" name="identity_card" id="identity_card" class="w-full px-3 py-2 text-sm bg-white border border-gray-200 rounded-md focus:outline-none" accept=".pdf,.jpg,.jpeg">
                            @error('identity_card')
                                <div class="text-sm text-error-500">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="flex flex-col mt-2">
                        <label for="adresse" class="mb-1 text-sm text-gray-500">Adresse</label>
                        <input type="text" name="adresse" id="adresse" class="w-full px-3 py-2 text-sm border border-gray-200 rounded-md focus:outline-none" placeholder="Entrez votre adresse" value="{{ Auth::user()->adresse }}">
                        @error('adresse')
                            <div class="text-sm text-error-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="flex flex-col mt-2">
                        <label for="telephone" class="mb-1 text-sm text-gray-500">Numéro de téléphone</label>
                        <input type="text" name="telephone" id="telephone" class="w-full px-3 py-2 text-sm border border-gray-200 rounded-md focus:outline-none" placeholder="Entrez votre numéro de téléphone" value="{{ Auth::user()->telephone }}">
                        @error('telephone')
                            <div class="text-sm text-error-500">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
        
                <div class="flex flex-col gap-2">
                    <span class="text-gray-500">Préférences</span>
                    <div class="flex flex-col">
                        <div class="flex items-center justify-between">
                            <label for="data_sharing" class="text-sm">Partage des données</label>
                            <label class="switch">
                                <input type="checkbox" name="data_sharing" id="data_sharing">
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <span class="text-[8px] text-gray-500">Partagez vos données afin de mettre en place des statistiques</span>
                    </div>
                    <div class="flex flex-col">
                        <div class="flex items-center justify-between">
                            <label for="newsletter" class="text-sm">Newsletter</label>
                            <label class="switch">
                                <input type="checkbox" name="newsletter" id="newsletter">
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <span class="text-[8px] text-gray-500">Vous abonner à la newsletter du site</span>
                    </div>
                    <div class="flex flex-col">
                        <div class="flex items-center justify-between">
                            <label for="a2f" class="text-sm">A2F</label>
                            <label class="switch">
                                <input type="checkbox" name="a2f" id="a2f">
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <span class="text-[8px] text-gray-500">Activer l’authentification à deux facteurs</span>
                    </div>
                </div>
        
                <div class="flex flex-col gap-2">
                    <span class="text-gray-500">Suppression du compte</span>
                    <div class="flex items-center gap-2">
                        <button type="button" class="w-full py-2 text-xs text-white rounded-md bg-error-500 focus:outline-none">Désactiver le compte</button>
                        <button type="button" class="w-full py-2 text-xs transition-all duration-300 border rounded-lg border-opacity-20 hover:border-opacity-80 text-error-500 border-error-500">Supprimer le compte</button>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Menu Préférences --}}
        <div id="tab3" class="hidden mt-4 tab-content">
            <div class="flex flex-col gap-4">
                <div class="flex flex-col gap-2">
                    <span class="text-gray-500">Notifications</span>
                    <div class="flex flex-col">
                        <div class="flex items-center justify-between">
                            <label for="email_notifications" class="text-sm">Notifications par e-mail</label>
                            <label class="switch">
                                <input type="checkbox" name="email_notifications" id="email_notifications">
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <span class="text-[8px] text-gray-500">Recevoir des notifications par e-mail</span>
                    </div>
                    <div class="flex flex-col">
                        <div class="flex items-center justify-between">
                            <label for="sound_notifications" class="text-sm">Notifications sonores</label>
                            <label class="switch">
                                <input type="checkbox" name="sound_notifications" id="sound_notifications">
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <span class="text-[8px] text-gray-500">Recevoir des notifications sonores</span>
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <span class="text-gray-500">Statut</span>
                    <div class="flex flex-col">
                        <div class="flex items-center justify-between">
                            <label for="online_status" class="text-sm">Statut En Ligne</label>
                            <label class="switch">
                                <input type="checkbox" name="online_status" id="online_status">
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <span class="text-[8px] text-gray-500">Afficher votre statut en ligne</span>
                    </div>
                    <div class="flex flex-col">
                        <div class="flex items-center justify-between">
                            <label for="typing_status" class="text-sm">Vu / En train d'écrire</label>
                            <label class="switch">
                                <input type="checkbox" name="typing_status" id="typing_status">
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <span class="text-[8px] text-gray-500">Afficher lorsque vous êtes en train d'écrire</span>
                    </div>
                </div>

                <div class="flex flex-col">
                    <span class="text-gray-500">Archivage</span>
                    <div class="flex items-center justify-between">
                        <label for="archive_duration" class="text-sm">Durée d'inactivité avant archivage</label>
                        <select name="archive_duration" id="archive_duration" class="w-1/4 px-3 py-1 text-sm border border-gray-200 rounded-md focus:outline-none">
                            <option value="1_month">1 mois</option>
                            <option value="3_months">3 mois</option>
                            <option value="6_months">6 mois</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </form>

</div>

<script>
    document.querySelector('button[type="button"]').addEventListener('click', function() {
        document.getElementById('profile_picture').click();
    });

    document.getElementById('profile_picture').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imageProfil').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });

    const tabs = document.querySelectorAll('[data-tab-target]');
    const classeActive = 'bg-white';
    const classeTextPrimary = 'text-primary-500';
    const classeTextGray = 'text-gray-700';

    // Sélectionner la première tab par défaut
    tabs[0].classList.add(classeActive, classeTextPrimary);
    tabs[0].classList.remove(classeTextGray);
    document.querySelector(tabs[0].dataset.tabTarget).classList.remove('hidden');

    // Ajouter un écouteur d'événement sur chaque bouton
    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            const targetContent = document.querySelector(tab.dataset.tabTarget);
            document.querySelectorAll('.tab-content').forEach(content => content.classList.add('hidden'));
            targetContent.classList.remove('hidden');

            tabs.forEach(activeTab => {
                activeTab.classList.remove(classeActive, classeTextPrimary);
                activeTab.classList.add(classeTextGray);
            });
            tab.classList.add(classeActive, classeTextPrimary);
            tab.classList.remove(classeTextGray);
        });
    });
</script>

@endsection