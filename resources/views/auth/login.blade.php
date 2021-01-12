<x-guest-layout>
    <script src="https://kit.fontawesome.com/40fd0fe410.js" crossorigin="anonymous"></script>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <i class="fas fa-sign-in-alt fa-4x"> Logowanie</i>
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">

            <a href="{{ url('/') }}" class="text-sm text-gray-700 underline">Strona Główna</a>

        </div>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label value="{{ __('Email') }}" />
                <x-jet-input class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label value="{{ __('Hasło') }}" />
                <x-jet-input class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <input type="checkbox" class="form-checkbox" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Zapamiętaj') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">


                <x-jet-button class="ml-4">
                    {{ __('Zaloguj') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
