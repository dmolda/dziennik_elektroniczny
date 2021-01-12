<x-guest-layout>
    <script src="https://kit.fontawesome.com/40fd0fe410.js" crossorigin="anonymous"></script>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <i class="fas fa-registered fa-4x">ejestracja</i>
        </x-slot>

        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">

                <a href="{{ url('/') }}" class="text-sm text-gray-700 underline">Strona Główna</a>

        </div>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-jet-label value="{{ __('Nazwa konta') }}" />
                <x-jet-input class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label value="{{ __('Email') }}" />
                <x-jet-input class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label value="{{ __('Hasło') }}" />
                <x-jet-input class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label value="{{ __('Powtórz hasło') }}" />
                <x-jet-input class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Posiadasz już konto?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Zarejestruj') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
