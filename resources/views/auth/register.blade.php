<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nome')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Cognome -->
        <div class="mt-4">
            <x-input-label for="cognome" :value="__('Cognome')" />
            <x-text-input id="cognome" class="block mt-1 w-full" type="text" name="cognome" :value="old('cognome')" required autofocus autocomplete="cognome" />
            <x-input-error :messages="$errors->get('cognome')" class="mt-2" />
        </div>

        <!-- Sesso -->
        <div class="mt-4">
            <x-input-label for="sesso" :value="__('Sesso')" />
            <x-text-input id="sesso" class="block mt-1 w-full" type="text" name="sesso" :value="old('sesso')" required autofocus autocomplete="sesso" />
            <x-input-error :messages="$errors->get('sesso')" class="mt-2" />
        </div>
        <!-- DataNascita -->
        <div class="mt-4">
            <x-input-label for="dataNascita" :value="__('Data di nascita')" />
            <x-text-input id="dataNascita" class="block mt-1 w-full" type="date" name="dataNascita" :value="old('dataNascita')" required autofocus autocomplete="dataNascita" />
            <x-input-error :messages="$errors->get('dataNascita')" class="mt-2" />
        </div>
        
        <!-- 'citta' -->
        <div class="mt-4">
            <x-input-label for="citta" :value="__('Citta')" />
            <x-text-input id="citta" class="block mt-1 w-full" type="text" name="citta" :value="old('citta')" required autofocus autocomplete="citta" />
            <x-input-error :messages="$errors->get('citta')" class="mt-2" />
        </div>

        <!-- indirizzo -->
        <div class="mt-4">
            <x-input-label for="indirizzo" :value="__('Indirizzo')" />
            <x-text-input id="indirizzo" class="block mt-1 w-full" type="text" name="indirizzo" :value="old('indirizzo')" required autofocus autocomplete="indirizzo" />
            <x-input-error :messages="$errors->get('indirizzo')" class="mt-2" />
        </div>

        <!-- cap -->
        <div class="mt-4">
            <x-input-label for="cap" :value="__('CAP')" />
            <x-text-input id="cap" class="block mt-1 w-full" type="text" name="cap" :value="old('cap')" required autocomplete="cap" />
            <x-input-error :messages="$errors->get('cap')" class="mt-2" />
        </div>

        <!-- telefono -->
        <div class="mt-4">
            <x-input-label for="telefono" :value="__('Telefono')" />
            <x-text-input id="telefono" class="block mt-1 w-full" type="text" name="telefono" :value="old('telefono')" required autocomplete="telefono" />
            <x-input-error :messages="$errors->get('indirizzo')" class="mt-2" />
        </div>

        <!-- codicefiscale -->
        <div class="mt-4">
            <x-input-label for="codicefiscale" :value="__('CF')" />
            <x-text-input id="codicefiscale" class="block mt-1 w-full" type="text" name="codicefiscale" :value="old('codicefiscale')" required autocomplete="codicefiscale" />
            <x-input-error :messages="$errors->get('codicefiscale')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="text" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Già registrato?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
