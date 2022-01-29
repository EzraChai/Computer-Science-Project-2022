<x-jet-action-section>
    <x-slot name="title">
        {{ __('Padamkan Akaun') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Padamkan akaun anda selama-lamanya.') }}
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600">
            {{ __('Setelah akaun anda dipadamkan, semua sumber dan datanya akan dipadamkan secara kekal. Sebelum memadam akaun anda, sila muat turun sebarang data atau maklumat yang anda ingin simpan.') }}
        </div>

        <div class="mt-5">
            <x-jet-danger-button wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                {{ __('Padamkan Akaun') }}
            </x-jet-danger-button>
        </div>

        <!-- Delete User Confirmation Modal -->
        <x-jet-dialog-modal wire:model="confirmingUserDeletion">
            <x-slot name="title">
                {{ __('Padamkan Akaun') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Adakah anda pasti hendak memadam akaun anda? Setelah akaun anda dipadamkan, semua sumber dan datanya akan dipadamkan secara kekal. Sila masukkan kata laluan anda untuk mengesahkan bahawa anda ingin memadamkan akaun anda secara kekal.') }}

                <div class="mt-4" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-jet-input type="password" class="mt-1 block w-3/4"
                                placeholder="{{ __('Kata laluan') }}"
                                x-ref="password"
                                wire:model.defer="password"
                                wire:keydown.enter="deleteUser" />

                    <x-jet-input-error for="password" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                    {{ __('Batalkan') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-2" wire:click="deleteUser" wire:loading.attr="disabled">
                    {{ __('Padamkan Akaun') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>
    </x-slot>
</x-jet-action-section>
