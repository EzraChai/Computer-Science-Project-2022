<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pengurusan Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @can('admin')
                <div class="bg-white mt-2 p-6 overflow-hidden shadow-xl sm:rounded-lg">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pengguna</h2>
                    <table class="table min-w-full mt-4">
                        <thead>
                            <tr>
                                <th
                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                    Nama</th>
                                <th
                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                    E-mel</th>
                                <th
                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                    Peranan</th>
                                <th
                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                    Potong</th>
                            </tr>
                        </thead>
                        @foreach ($users as $user)
                            <tbody class="bg-white">
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="flex items-center">
                                            <div class=" pr-2">
                                                <img class="h-10 w-10 rounded-full object-cover"
                                                    src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}">
                                            </div>
                                            <div class="text-sm font-medium leading-5 text-gray-900">
                                                {{ $user->name }}
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-500">{{ $user->email }}</div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        @if ($user->is_admin)
                                            <form action='{{ "/user/$user->id/admin" }}' method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">Urus
                                                    Setia</button>
                                            </form>
                                        @else
                                            <form action='{{ "/user/$user->id/admin" }}' method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="inline-flex px-2 text-xs font-semibold leading-5 text-purple-800 bg-purple-100 rounded-full">Hakim</button>
                                            </form>
                                        @endif
                                    </td>
                                    <td
                                        class="px-6 py-4 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                        <form action='{{ "/user/$user->id" }}' method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <a href="#delete{{ $user->id }}" class="">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="w-6 h-6 text-CandyPink cursor-pointer" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </a>
                                            <div id="delete{{ $user->id }}" class="modal">
                                                <div class="modal-box whitespace-normal text-gray-800 text-lg ">
                                                    <p>{{ "Pengguna \"" . $user->name . "\" akan dipadamkan." }}
                                                    </p>
                                                    <div class="modal-action">
                                                        <button type="submit" for="my-modal-2"
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
                            <form method="POST"  class=" form-group" action='{{ "/user/search" }}'>
                                @csrf
                                <input name="name" class="input input-bordered text-gray-900" type="text" placeholder="Cari Pengguna">
                                <button class="btn " type="submit">Cari</button>
                            </form>
                        <a href="/user/create"
                            class="hover:scale-105 transform text-gray-800 transition  font-semibold py-2 px-4 border border-gray-400 rounded shadow">Pengguna
                            Baharu</a>
                    </div>
                @endcan
            </div>
        </div>
    </div>
</x-app-layout>
