@extends('layout')

@section('titre', __('EditingProfile'))

@section('contenu')

<div class="flex flex-col gap-3 mx-8 md:w-3/4 md:mx-auto">

    <form action="{{ route('user.update', ['id' => $user->id, 'from' => request()->query('from')]) }}" method="POST" enctype="multipart/form-data" class="flex flex-col">
        @csrf
        
        {{-- Navigation --}}
        <div class="relative flex items-center justify-between w-full">
            <a href="{{ url()->previous() }}" class="absolute left-0 text-sm text-default/50 md:text-base md:hidden hover:text-default/80">
                <i class="fa-solid fa-chevron-left"></i> {{ __('Cancel') }}
            </a>
            
            <span class="mx-auto font-medium md:text-3xl md:mb-8">{{ __('EditingProfile') }}</span>
            <button type="submit" class="absolute right-0 font-medium md:hidden text-primary">{{ __('Save') }}</button>
        </div>

        {{-- Entête --}}
        <div class="relative flex flex-col items-center gap-4 mt-8 md:mt-0 md:flex-row">
            <div class="relative">
                <img id="imageProfil" src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('assets/default_pfp.png') }}" alt="Avatar" class="rounded-full size-20 md:size-24">
                <button type="button" id="changePPButton" class="absolute flex items-center justify-center size-8" style="bottom: -5px; right: -5px;">
                    <span class="fa-stack fa-1x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa-regular fa-pen fa-stack-1x fa-inverse"></i>
                    </span>
                </button>
                <input type="file" name="profile_picture" class="hidden" id="profile_picture">
            </div>
            <div class="flex flex-col items-center md:items-start">                
                <span class="text-2xl font-bold md:text-4xl">{{$user->first_name . ' ' . $user->last_name }}</span>
                <span class="text-base text-default/50">{{ '@' . strtolower($user->first_name . $user->last_name) }} </span>
            </div>
            <div class="absolute right-0 items-center hidden md:flex">
                <a href="{{ route('user.index', ['id' => Auth::id()]) }}" class="hidden mr-4 text-sm text-default/50 md:text-base md:block hover:text-default/80">
                    {{ __('Cancel') }}
                </a>
                <button type="submit" class="hidden px-4 py-2 text-sm text-center text-white rounded-lg md:text-base md:block md:duration-300 md:transition-all bg-primary hover:bg-opacity-80">{{ __('Save') }}</button>
            </div>
        </div>

        {{-- Tabs --}}
        <div class="flex flex-wrap px-1 py-1 mt-4 rounded-lg bg-input-border tab-section md:hidden">
            <button type="button" class="flex-grow p-1 font-medium text-gray-700 rounded-lg" data-tab-target="#tab1">{{ __('Profile') }}</button>
            <button type="button" class="flex-grow p-1 font-medium text-gray-700 rounded-lg" data-tab-target="#tab2">{{ __('Account') }}</button>
            <button type="button" class="flex-grow p-1 font-medium text-gray-700 rounded-lg" data-tab-target="#tab3">{{ __('Preferences') }}</button>
        </div>

        {{-- Menu Profil --}}
        <div id="tab1" class="hidden mt-4 tab-content md:block">
            <div class="items-center hidden gap-4 md:flex">
                <hr class="w-full border-t border-input-border">
                <span class="text-xl font-medium">{{ __('Profile') }}</span>
                <hr class="w-full border-t border-input-border">
            </div>
            <div class="flex flex-col gap-4">
                <div class="flex flex-col gap-4 md:flex-row">
                    <div class="flex flex-col">
                        <label for="first_name" class="mb-1 text-default/50">{{ __('FirstName') }}</label>
                        <input type="text" name="first_name" id="first_name" class="w-full px-3 py-2 text-sm border rounded-md border-input-border bg-input md:text-base focus:outline-none" placeholder="{{ __('FirstName') }}" value="{{ $user->first_name }}">
                        @error('first_name')
                            <div class="text-sm md:text-base text-error">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="flex flex-col">
                        <label for="last_name" class="mb-1 text-default/50">{{ __('LastName') }}</label>
                        <input type="text" name="last_name" id="last_name" class="w-full px-3 py-2 text-sm border rounded-md border-input-border bg-input md:text-base focus:outline-none" placeholder="{{ __('LastName') }}" value="{{ $user->last_name }}">
                        @error('last_name')
                            <div class="text-sm md:text-base text-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
        
                <div class="flex flex-col">
                    <label for="description" class="mb-1 text-default/50">{{ __('AboutMe') }}</label>
                    <textarea name="description" id="description" rows="5" class="w-full px-3 py-2 text-sm border rounded-md border-input-border bg-input md:text-base focus:outline-none" placeholder="{{ __('AboutMe') }}" value="{{ $user->description }}"></textarea>
                    @error('description')
                        <div class="text-sm md:text-base text-error">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Menu Compte --}}
        <div id="tab2" class="hidden mt-4 tab-content md:block md:mt-8">
            <div class="items-center hidden gap-4 md:flex">
                <hr class="w-full border-t border-input-border">
                <span class="text-xl font-medium">{{ __('Account') }}</span>
                <hr class="w-full border-t border-input-border">
            </div>
            <div class="flex flex-col gap-4">
                <div class="flex flex-col">
                    <label for="email" class="mb-1 text-default/50">{{ __('Email') }}</label>
                    <input type="email" name="email" id="email" class="w-full px-3 py-2 text-sm border rounded-md border-input-border bg-input md:text-base focus:outline-none" placeholder="{{ __('Email') }}" value="{{ $user->email }}">
                    @error('email')
                        <div class="text-sm md:text-base text-error">{{ $message }}</div>
                    @enderror
                </div>
        
                <div class="flex flex-col gap-2">
                    <div class="flex flex-col">
                        <label for="current_password" class="mb-1 text-default/50">{{ __('CurrentPassword') }}</label>
                        <input type="password" name="current_password" id="current_password" class="w-full px-3 py-2 text-sm border rounded-md border-input-border bg-input md:text-base focus:outline-none" placeholder="{{ __('CurrentPassword') }}">
                        @error('current_password')
                            <div class="text-sm md:text-base text-error">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <div class="flex gap-2">
                        <div class="flex flex-col md:flex-grow">
                            <input type="password" name="new_password" id="new_password" class="w-full px-3 py-2 text-sm border rounded-md border-input-border bg-input md:text-base focus:outline-none" placeholder="{{ __('NewPassword') }}">
                            @error('new_password')
                                <div class="text-sm md:text-base text-error">{{ $message }}</div>
                            @enderror
                        </div>
                
                        <div class="flex flex-col md:flex-grow">
                            <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="w-full px-3 py-2 text-sm border rounded-md border-input-border bg-input md:text-base focus:outline-none" placeholder="{{ __('ConfirmNewPassword') }}">
                            @error('new_password_confirmation')
                                <div class="text-sm md:text-base text-error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
            
                    <form action="{{ route('user.updatePassword', $user->id) }}" method="POST">
                        @csrf
                        <button type="button" class="w-full px-3 py-2 text-sm text-white rounded-md md:text-base bg-primary">{{ __('ChangePassword') }}</button>
                    </form>
                </div>
        
                <div class="flex flex-col">
                    <span class="mb-2 text-default/50">{{ __('AdditionalInformation') }}</span>
                    <div class="flex gap-4">
                        <div class="flex flex-col w-1/2">
                            <label for="birth_date" class="mb-1 text-sm text-default/50 md:text-base">{{ __('BirthDate') }}</label>
                            <input type="date" name="birth_date" id="birth_date" class="w-full px-3 py-2 text-sm border rounded-md border-input-border bg-input md:text-base focus:outline-none" value="{{ \Carbon\Carbon::parse($user->birth_date)->format('Y-m-d') }}">
                            @error('birth_date')
                                <div class="text-sm md:text-base text-error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="flex flex-col w-1/2">
                            <label for="identity_card" class="mb-1 text-sm text-default/50 md:text-base">{{ __('IdentityCard') }}</label>
                            <input type="file" name="identity_card" id="identity_card" class="w-full px-3 py-2 text-sm border rounded-md border-input-border bg-input md:text-base focus:outline-none" accept=".pdf,.jpg,.jpeg">
                            @error('identity_card')
                                <div class="text-sm md:text-base text-error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="flex flex-col mt-2">
                        <label for="adresse" class="mb-1 text-sm text-default/50 md:text-base">{{ __('Address') }}</label>
                        <input type="text" name="adresse" id="adresse" class="w-full px-3 py-2 text-sm border rounded-md border-input-border bg-input md:text-base focus:outline-none" placeholder="{{ __('Address') }}" value="{{ $user->adresse }}">
                        @error('adresse')
                            <div class="text-sm md:text-base text-error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="flex flex-col mt-2">
                        <label for="telephone" class="mb-1 text-sm text-default/50 md:text-base">{{ __('PhoneNumber') }}</label>
                        <input type="text" name="telephone" id="telephone" class="w-full px-3 py-2 text-sm border rounded-md border-input-border bg-input md:text-base focus:outline-none" placeholder="{{ __('PhoneNumber') }}" value="{{ $user->telephone }}">
                        @error('telephone')
                            <div class="text-sm md:text-base text-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
        
                <div class="flex flex-col gap-2">
                    <span class="text-default/50">{{ __('Data') }}</span>
                    <div class="flex flex-col">
                        <div class="flex items-center justify-between">
                            <label for="data_sharing" class="text-sm md:text-base">{{ __('DataSharing') }}</label>
                            <label class="switch">
                                <input type="checkbox" name="data_sharing" id="data_sharing">
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <span class="text-[8px] md:text-sm text-default/50">{{ __('DataSharingDescription') }}</span>
                    </div>
                    <div class="flex flex-col">
                        <div class="flex items-center justify-between">
                            <label for="newsletter" class="text-sm md:text-base">{{ __('Newsletter') }}</label>
                            <label class="switch">
                                <input type="checkbox" name="newsletter" id="newsletter">
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <span class="text-[8px] md:text-sm text-default/50">{{ __('NewsletterDescription') }}</span>
                    </div>
                    <div class="flex flex-col">
                        <div class="flex items-center justify-between">
                            <label for="a2f" class="text-sm md:text-base">{{ __('TwoFactorAuth') }}</label>
                            <label class="switch">
                                <input type="checkbox" name="a2f" id="a2f">
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <span class="text-[8px] md:text-sm text-default/50">{{ __('TwoFactorAuthDescription') }}</span>
                    </div>
                </div>
        
                <div class="flex flex-col gap-2">
                    <span class="text-default/50">{{ __('AccountDeletion') }}</span>
                    <div class="flex items-center gap-2">
                        <button type="button" class="w-full py-2 text-xs text-white rounded-md md:text-sm bg-error focus:outline-none">{{ __('DeactivateAccount') }}</button>
                        <button type="button" class="w-full py-2 text-xs transition-all duration-300 border rounded-lg md:text-sm border-opacity-20 hover:border-opacity-80 text-error border-error">{{ __('DeleteAccount') }}</button>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Menu Préférences --}}
        <div id="tab3" class="hidden mt-4 tab-content md:block md:mt-8">
            <div class="items-center hidden gap-4 md:flex">
                <hr class="w-full border-t border-input-border">
                <span class="text-xl font-medium">{{ __('Preferences') }}</span>
                <hr class="w-full border-t border-input-border">
            </div>
            <div class="flex flex-col gap-4">
                <div class="flex flex-col gap-2">
                    <span class="text-default/50">{{ __('Notifications') }}</span>
                    <div class="flex flex-col">
                        <div class="flex items-center justify-between">
                            <label for="email_notifications" class="text-sm md:text-base">{{ __('EmailNotifications') }}</label>
                            <label class="switch">
                                <input type="checkbox" name="email_notifications" id="email_notifications">
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <span class="text-[8px] md:text-sm text-default/50">{{ __('EmailNotificationsDescription') }}</span>
                    </div>
                    <div class="flex flex-col">
                        <div class="flex items-center justify-between">
                            <label for="sound_notifications" class="text-sm md:text-base">{{ __('SoundNotifications') }}</label>
                            <label class="switch">
                                <input type="checkbox" name="sound_notifications" id="sound_notifications">
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <span class="text-[8px] md:text-sm text-default/50">{{ __('SoundNotificationsDescription') }}</span>
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <span class="text-default/50">{{ __('Status') }}</span>
                    <div class="flex flex-col">
                        <div class="flex items-center justify-between">
                            <label for="online_status" class="text-sm md:text-base">{{ __('OnlineStatus') }}</label>
                            <label class="switch">
                                <input type="checkbox" name="online_status" id="online_status">
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <span class="text-[8px] md:text-sm text-default/50">{{ __('OnlineStatusDescription') }}</span>
                    </div>
                    <div class="flex flex-col">
                        <div class="flex items-center justify-between">
                            <label for="typing_status" class="text-sm md:text-base">{{ __('TypingStatus') }}</label>
                            <label class="switch">
                                <input type="checkbox" name="typing_status" id="typing_status">
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <span class="text-[8px] md:text-sm text-default/50">{{ __('TypingStatusDescription') }}</span>
                    </div>
                </div>

                <div class="flex flex-col">
                    <span class="text-default/50">{{ __('Archiving') }}</span>
                    <div class="flex items-center justify-between">
                        <label for="archive_duration" class="text-sm md:text-base">{{ __('ArchiveDuration') }}</label>
                        <select name="archive_duration" id="archive_duration" class="w-1/4 px-3 py-1 text-sm border rounded-md border-input-border bg-input md:text-base focus:outline-none">
                            <option value="1_month">{{ __('OneMonth') }}</option>
                            <option value="3_months">{{ __('ThreeMonths') }}</option>
                            <option value="6_months">{{ __('SixMonths') }}</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </form>

</div>

<script>
    document.getElementById('changePPButton').addEventListener('click', function() {
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
    const classeTextPrimary = 'text-primary';
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
