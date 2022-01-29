<x-jet-action-section>
    <x-slot name="title">
        {{ __('Pengesahan Dua Faktor') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Jaminkan keselamatan akaun anda apabila menggunakan pengesahan dua faktor.') }}
    </x-slot>

    <x-slot name="content">
        <h3 class="text-lg font-medium text-gray-900">
            @if ($this->enabled)
                {{ __('Anda telah mendayakan pengesahan dua faktor.') }}
            @else
                {{ __('Anda tidak mendayakan pengesahan dua faktor.') }}
            @endif
        </h3>

        <div class="mt-3 max-w-xl text-sm text-gray-600">
            <p>
                {{ __('Apabila dua pengesahan faktor didayakan, anda akan digesa untuk token rawak yang selamat semasa pengesahan. Anda boleh mendapatkan semula token ini daripada aplikasi Pengesah Google telefon anda.') }}
            </p>
        </div>

        @if ($this->enabled)
            @if ($showingQrCode)
                <div class="mt-4 max-w-xl text-sm text-gray-600">
                    <p class="font-semibold">
                        {{ __('Pengesahan dua faktor kini didayakan. Imbas kod QR berikut menggunakan aplikasi pengesah telefon anda.') }}
                    </p>
                </div>

                <div class="mt-4">
                    {!! $this->user->twoFactorQrCodeSvg() !!}
                </div>
            @endif

            @if ($showingRecoveryCodes)
                <div class="mt-4 max-w-xl text-sm text-gray-600">
                    <p class="font-semibold">
                        {{ __('Simpan kod pemulihan ini dalam pengurus kata laluan yang selamat. Ia boleh digunakan untuk memulihkan akses kepada akaun anda jika peranti pengesahan dua faktor anda hilang.') }}
                    </p>
                </div>

                <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 rounded-lg">
                    @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                        <div>{{ $code }}</div>
                    @endforeach
                </div>
            @endif
        @endif

        <div class="mt-5">
            @if (! $this->enabled)
                <x-jet-confirms-password wire:then="enableTwoFactorAuthentication">
                    <x-jet-button type="button" wire:loading.attr="disabled">
                        {{ __('Mengaktifkan') }}
                    </x-jet-button>
                </x-jet-confirms-password>
            @else
                @if ($showingRecoveryCodes)
                    <x-jet-confirms-password wire:then="regenerateRecoveryCodes">
                        <x-jet-secondary-button class="mr-3">
                            {{ __('Menjana Semula Kod Pemulihan') }}
                        </x-jet-secondary-button>
                    </x-jet-confirms-password>
                @else
                    <x-jet-confirms-password wire:then="showRecoveryCodes">
                        <x-jet-secondary-button class="mr-3">
                            {{ __('Tunjukkan Kod Pemulihan') }}
                        </x-jet-secondary-button>
                    </x-jet-confirms-password>
                @endif

                <x-jet-confirms-password wire:then="disableTwoFactorAuthentication">
                    <x-jet-danger-button wire:loading.attr="disabled">
                        {{ __('Menyahdayakan') }}
                    </x-jet-danger-button>
                </x-jet-confirms-password>
            @endif
        </div>
    </x-slot>
</x-jet-action-section>
