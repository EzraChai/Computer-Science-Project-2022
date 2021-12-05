<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="/dashboard/competition/{{$competition_id}}/participant/{{$participant -> id}}">
            @method("PATCH")
            @csrf
            <input type="hidden" name="comp_type" value="{{$competition_type}}">
            <div class=" text-2xl font-semibold mb-4">Edit Peserta</div>
            @if($competition_type == "Seirama")
                <div>
                    <x-jet-label for="name1" value="{{ __('Nama Peserta 1') }}" />
                    <x-jet-input id="name1" class="block mt-1 w-full placeholder-gray-400" type="text" name="name1" placeholder="Ah Chong" value="{{old('name1') ?? $participant -> name }}" required autofocus/>
                </div>

                <div class="mt-4">
                    <x-jet-label for="identity1" value="{{ __('Kad Pengenalan Peserta 1') }}" />
                    <x-jet-input id="identity1" class="block mt-1 w-full placeholder-gray-400" type="text" name="identity1" placeholder="012345001234" value="{{old('identity1') ?? $participant -> identity }}" required />
                </div>

                <div class="mt-4">
                    <x-jet-label for="name2" value="{{ __('Nama Peserta 1') }}" />
                    <x-jet-input id="name2" class="block mt-1 w-full placeholder-gray-400" type="text" name="name2" placeholder="Ah Beng" value="{{old('name2') ?? $participant -> secondName }}" required autofocus/>
                </div>

                <div class="mt-4">
                    <x-jet-label for="identity2" value="{{ __('Kad Pengenalan Peserta 2') }}" />
                    <x-jet-input id="identity2" class="block mt-1 w-full placeholder-gray-400" type="text" name="identity2" placeholder="012345001235" value="{{old('identity2') ?? $participant -> secondIdentity }}" required />
                </div>
            @else
                <div>
                    <x-jet-label for="name" value="{{ __('Nama') }}" />
                    <x-jet-input id="name" class="block mt-1 w-full placeholder-gray-400" type="text" name="name" placeholder="Ah Chong" value="{{old('name') ?? $participant -> name}}" required autofocus/>
                </div>

                <div class="mt-4">
                    <x-jet-label for="identity" value="{{ __('Kad Pengenalan') }}" />
                    <x-jet-input id="identity" class="block mt-1 w-full placeholder-gray-400" type="text" name="identity" placeholder="012345001234" value="{{old('identity') ?? $participant -> identity}}" required />
                </div>
            @endif
            <div class="mt-4">
                <x-jet-label for="school" value="{{ __('Asal') }}" />
                <x-jet-input id="school" class="block mt-1 w-full placeholder-gray-400" type="text" name="school" placeholder="SMK Tinggi Port Dickson" value="{{old('school') ?? $participant -> school}}" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button class="btn ml-4">
                    {{ __('Edit') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>

