<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" p-6 overflow-hidden">
                    <form action="/dashboard/competition/{{$competition->id}}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="p-4 bg-white shadow-lg rounded-md text-left mx-auto max-w-2xl">
                <h2 class="font-semibold text-xl text-gray-800 mb-6 leading-tight">Ubah Maklumat Pertandingan</h2>

                        <label class="block">
                            <span class="text-gray-700">Tajuk Pertandingan</span>
                            <input name="pertandingan-tajuk" class="form-input mt-1 block border-2 text-gray-800  w-full p-2 @error('pertandingan-tajuk') border-red-500 @enderror" placeholder="Pertandingan Terjun Peringkat Kebangsaan" value="{{old('pertandingan-tajuk') ?? $competition->name}}"/>
                        </label>

                        <div class="mt-4">
                            <label class="block">
                                <span class="text-gray-700">Tempat Pertandingan</span>
                                <input name="pertandingan-avenue" class="form-input text-gray-800  mt-1 border-2 block w-full p-2 @error('pertandingan-avenue') border-red-500 @enderror" placeholder="Kompleks Sukan Malaysia" value="{{old('pertandingan-avenue') ?? $competition->avenue}}" />
                            </label>
                        </div>

                        <div class="mt-4">
                            <span class="text-gray-700">Tarik Pertandingan</span>
                            <div class="mt-2">
                            <label class="inline-flex items-center">
                                <input
                                type="date"
                                name="pertandingan-date"
                                class="text-gray-600 px-2 @error('pertandingan-date') border-red-500 @enderror"
                                value="{{old('pertandingan-date') ?? $competition->date }}"
                                />
                            </label>
                            </div>
                        </div>
                        <div class="mt-8 w-full flex justify-end">
                            <button
                                class="
                                    text-gray-800
                                    bg-transparent
                                    border border-solid border-gray-500
                                    hover:bg-YInMnBlue hover:text-white
                                    active:bg-gray-600
                                    font-bold
                                    uppercase
                                    text-sm
                                    px-6
                                    py-3
                                    outline-none
                                    focus:outline-none
                                    mr-1
                                    mb-1
                                    ease-linear
                                    transition-all
                                    duration-150
                                    rounded-none
                                    btn
                                "
                                type="submit"
                                >
                                Ubah
                                </button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</x-app-layout>
