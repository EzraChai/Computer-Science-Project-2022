<x-app-layout>
    <x-slot name="header print:hidden">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ">
            {{ __('Pengurusan Peserta') }}
        </h2>
    </x-slot>
   
    <div class="py-12 print:py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
             @if(session('status'))
                <div class="toast ">
                    <div class="alert alert-success">
                        <div>
                        <span>{{session('status')}}</span>
                        </div>
                    </div>
            @endif
                @can('admin')
                <a href="/dashboard/competition/{{$competition_id}}" class="btn left-64 text-xl absolute print:hidden">←</a>
                <div class="bg-white mt-4 p-6 overflow-hidden shadow-xl sm:rounded-lg">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Peserta</h2>
                <table class="table min-w-full mt-4">
                                    <thead>
                                        <tr>
                                            @if($competition_type == "Seirama")
                                               <th
                                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                                Nama Peserta 1</th>
                                            <th
                                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                                Kad Pengenalan Peserta 1</th>
                                            <th
                                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                                Nama Peserta 2</th>
                                            <th
                                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                                Kad Pengenalan Peserta 2</th> 
                                            @endif
                                            @if($competition_type == "Solo")
                                            <th
                                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                                Nama</th>
                                            <th
                                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                                Kad Pengenalan</th>
                                            @endif
                                            <th
                                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                                Asal</th>
                                                <th
                                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                                Edit</th>
                                            <th
                                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                                Potong</th>
                                        </tr>
                                    </thead>
                                    @foreach ($participants as $participant)
                                    <tbody class="bg-white">
                                        <tr>
                                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                <div class="text-sm font-medium leading-5 text-gray-900">
                                                    {{$participant -> name}}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                <div class="text-sm font-medium leading-5 text-gray-900">
                                                    {{$participant -> identity}}
                                                </div>
                                            </td>
                                            @if($competition_type == "Seirama")
                                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                <div class="text-sm font-medium leading-5 text-gray-900">
                                                    {{$participant -> secondName}}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                <div class="text-sm font-medium leading-5 text-gray-900">
                                                    {{$participant -> secondIdentity}}
                                                </div>
                                            </td>
                                           
                                            @endif
                                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                <div class="text-sm font-medium leading-5 text-gray-900">
                                                    {{$participant -> school}}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                    <a href="/dashboard/competition/{{$competition_id}}/participant/{{$participant->id}}/edit" class="text-sm leading-5 text-gray-500">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-400 cursor-pointer"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                                </td>
                                            <td
                                                class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                                <form action='{{"/dashboard/competition/$competition_id/participant/$participant->id"}}' method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                        <a href="#delete{{ $participant->id }}" for="my-modal-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-400 cursor-pointer"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                    </a> 
                                                        <div id="delete{{$participant->id}}" class="modal">
                                                            <div class="modal-box whitespace-normal text-gray-800 text-lg ">
                                                                    <p>{{"Peserta yang bernama \"". $participant->name . "\" akan dipadamkan."}}</p>
                                                                    <p>Sila berfikir dengan teliti sebelum memadamkannya.</p>
                                                                    <div class="modal-action">
                                                                        <button type="submit"
                                                                            class="btn bg-red-500 border-0 hover:bg-red-700 ">Padam</button>
                                                                        <a href="#close" class="btn">Batal</a>
                                                                    </div>
                                                            </div>
                                                        </div>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="flex w-full justify-between mt-4">
                                    <button onclick="window.print()" class="btn rounded">Cetak</button>
                                    <a href='{{"/dashboard/competition/$competition_id/participant/create"}}'' class="hover:scale-105 transform text-gray-800 transition  font-semibold py-2 px-4 border border-gray-400 rounded shadow">Mendaftar Peserta</a>
                                </div>
                            @endcan
            </div>
        </div>
    </div>
    
</x-app-layout>
