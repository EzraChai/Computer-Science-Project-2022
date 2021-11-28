<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="/user/register">
            @csrf

            <div>
                <x-jet-label for="name" value="{{ __('Nama') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('E-mel') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Jenis Akaun') }}" />
                <div class="mt-2">
                <label class="inline-flex items-center">
                    <input
                    type="radio"
                    class="form-radio"
                    name="accountType"
                    value="urusSetia"
                    />
                    <span class="ml-2">Urus Setia</span>
                </label>
                <label class="inline-flex items-center ml-6">
                    <input
                    type="radio"
                    class="form-radio"
                    name="accountType"
                    value="hakim"
                    checked
                    />
                    <span class="ml-2">Hakim</span>
                </label>
                </div>
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Kata laluan') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Sahkan Kata laluan') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button class="ml-4">
                    {{ __('Mendaftar') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
