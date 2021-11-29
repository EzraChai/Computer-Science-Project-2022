<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="/dashboard/competition/{{$competition_id}}/participant">
            @csrf
            <div class=" text-2xl font-semibold mb-4">Mendaftar Peserta</div>
            <div>
                <x-jet-label for="name" value="{{ __('Nama') }}" />
                <x-jet-input id="name" class="block mt-1 w-full placeholder-gray-400" type="text" name="name" placeholder="Ah Chong" :value="old('name')" required autofocus/>
            </div>

            <div class="mt-4">
                <x-jet-label for="identity" value="{{ __('Kad Pengenalan') }}" />
                <x-jet-input id="identity" class="block mt-1 w-full placeholder-gray-400" type="text" name="identity" placeholder="012345001234" :value="old('identity')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="school" value="{{ __('Sekolah') }}" />
                <x-jet-input id="school" class="block mt-1 w-full placeholder-gray-400" type="text" name="school" placeholder="SMK Tinggi Port Dickson" :value="old('school')" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button class="btn ml-4">
                    {{ __('Daftar') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
