<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div data-theme="fantasy" class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
           

            <div class="bg-white mt-2 p-6 overflow-hidden shadow-xl sm:rounded-lg">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pertandingan</h2>
                <table class="table min-w-full mt-4">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                                    Tajuk</th>
                                                <th
                                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                                    Tempat</th>
                                                <th
                                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                                    Tarikh</th>
                @can('admin')

                                                <th
                                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                                    Edit</th>
                                                <th
                                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                                    Potong</th>
                @endcan
                                            </tr>
                                        </thead>
                                        @foreach ($competitions as $competition)
                                        <tbody class="bg-white">
                                            <tr>
                                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                    <div class="text-sm font-medium leading-5 ">
                                                        <a href="/dashboard/competition/{{$competition->id}}" class="text-gray-900 hover:underline">{{$competition -> name}}</a>
                                                    </div>
                                                </td>

                                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                    <div class="text-sm leading-5 text-gray-500">{{$competition -> avenue}}</div>
                                                </td>

                                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                    <div class="text-sm leading-5 text-gray-500">{{$competition -> date}}</div>
                                                
                                                </td>
                @can('admin')

                                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                    <a href="/dashboard/competition/{{$competition->id}}/edit" class="text-sm leading-5 text-gray-500">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-400 cursor-pointer"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                                </td>

                                                <td
                                                    class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                    <form action='{{"/dashboard/competition/$competition->id"}}' method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <label for="my-modal-2" type="button" class="modal-button">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-400 cursor-pointer"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                        </label>
                                                        <input type="checkbox" id="my-modal-2" class="modal-toggle"> 
                                                        <div class="modal">
                                                            <div class="modal-box whitespace-normal text-gray-800 text-lg ">
                                                                    <p class="">{{"Pertandingan yang bertajuk \"". $competition-> name. "\" akan dipadamkan."}}</p>
                                                                    <p>Sila berfikir dengan teliti sebelum memadamnya.</p> 
                                                                    <div class="modal-action">
                                                                    <button type="submit" for="my-modal-2" class="btn bg-red-500 border-0 hover:bg-red-700 ">Padam</button> 
                                                                    <label for="my-modal-2" class="btn">Tutup</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </td>
                @endcan
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                @can('admin')
                                    <div class="flex w-full justify-end mt-4">
                                        <a href="/dashboard/competition/create" class="hover:scale-105 transform text-gray-800 transition  font-semibold py-2 px-4 border border-gray-400 rounded shadow">Menganjurkan Pertandingan</a>
                                    </div>
                @endcan
                                </div>
                            <MySimpleComponent/>
            </div>
        </div>
    </div>
</x-app-layout>
