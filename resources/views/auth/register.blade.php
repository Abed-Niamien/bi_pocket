<x-guest-layout>
    <!-- Haut de page : Bouton retour + Titre -->
    <div class="w-full max-w-md mx-auto mt-6 px-4">
        <div class="flex items-center justify-between mb-4">
            <!-- Bouton retour -->
            <a href="{{ url('/') }}" class="inline-flex items-center px-3 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                ← Accueil
            </a>
        </div>

        <!-- Titre -->
        <h2 class="text-center text-xl font-semibold text-gray-800">
            Formulaire de creation de votre compte entreprise
        </h2>
    </div>

    <!-- Formulaire d'inscription -->
    <form method="POST" action="{{ route('register') }}" class="max-w-md mx-auto mt-4 px-4">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nom et prénoms')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Mot de passe')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Boutons -->
        <div class="flex items-center justify-end mt-4 flex-wrap gap-2">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Vous avez déjà un compte ?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Enregistrer') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
