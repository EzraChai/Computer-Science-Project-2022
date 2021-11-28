<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("Pertandingan") }}
        </h2>
    </x-slot>

                                    @can("admin")
    <div data-theme="fantasy" class="py-6">
                                    @endcan
                                    @cannot("admin")
    <div data-theme="pastel" class="py-6">
                                    @endcannot
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-row w-full">
                <div class="grid grid-cols-1 gap-6 lg:p-10 xl:grid-cols-3 w-full rounded-box">
                    <a href="/dashboard" class="btn left-64 text-xl absolute">←</a>
                    <div class="card shadow-lg side col-span-2  bg-base-100">
                        <div class="flex-row items-center space-x-4 card-body">
                        <div class="flex-1">
                             <p class="text-base-content text-opacity-60">Tajuk Pertandingan</p>
                            <h1 class="card-title text-YInMnBlue font-extrabold text-4xl">{{$competition-> name}}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow-lg side col-span-1 bg-base-100">
                        <div class="flex-row items-center space-x-4 card-body">
                        <div class="flex-1">
                             <p class="text-base-content text-opacity-60">Tarikh Pertandingan</p>
                            <h1 class="card-title text-4xl font-extrabold text-YInMnBlue">{{date('d/m/Y',strtotime($competition-> date))}}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow-lg side col-span-2  bg-base-100">
                        <div class="flex-row items-center space-x-4 card-body">
                        <div class="flex-1">
                             <p class="text-base-content text-opacity-60">Tempat Pertandingan</p>
                            <h1 class="card-title text-4xl font-extrabold text-YInMnBlue">{{$competition-> avenue}}</h1>
                            </div>
                        </div>
                    </div>
                         <div class="card shadow-lg side col-span-1 bg-base-100">
                        <div class="flex-row items-center space-x-4 card-body">
                        <div class="flex-1">
                             <p class="text-base-content text-opacity-60">Jumlah Bilangan Peserta</p>
                            <h1 class="card-title text-4xl font-extrabold text-YInMnBlue">{{$participantsCount}}</h1>
                            @can("admin")
                            <div class="flex-0 float-right">
                                <a href="/dashboard/competition/{{$competition->id}}/participant" class="btn btn-sm">Urus Peserta</a>
                            </div>
                            @endcan
                            </div>
                        </div>
                    </div>
                    <div class="card col-span-1 row-span-3 shadow-lg xl:col-span-3 bg-base-100">
                        <div class="card-body text-gray-800">
                            @foreach ($rounds as $round)
                            <div class="collapse w-full mt-4 shadow-sm collapse-arrow">
                            <input type="checkbox"> 
                            <div class="collapse-title text-xl font-medium">
                                Pusingan ke-{{$round-> round }}
                            </div> 
                            <div class="collapse-content"> 
                                <table class="table w-full">
                                <thead>
                                <tr>
                                    <th></th> 
                                    <th>Nama</th> 
                                    <th>Sekolah</th> 
                                    <th>Markah</th>
                                    <th>Jumlah Markah</th>
                                    @cannot("admin")
                                    <th>Tambah Markah</th>
                                    @endcannot
                                </tr>
                                </thead> 
                                <tbody>
                                    @foreach ($participantsMark as $key => $participantMark)
                                <tr>
                                    <th>{{$key + 1}}</th> 
                                    <td>{{$participantMark -> peserta -> name}}</td> 
                                    <td>{{$participantMark -> peserta -> school}}</td> 
                                    <td>{{$participantMark -> marks}}</td>
                                    <td>{{$participantMark -> total_marks}}</td>
                                    @cannot("admin")
                                    <td>
                                        @if ($participantMark -> marks == 0)
                                            <a href="#add-marks" class="btn btn-primary btn-sm modal-button">tambah</a>
                                        @else
                                            <button class="btn btn-secondary btn-sm">Ubah</button>
                                        @endif
                                    </td>
                                    <form action={{"/dashboard/competition/".$competition->id."/participant/".$participantMark -> peserta -> id."/add-marks"}} method="POST">
                                        @csrf

                                        <input type="hidden" name="participant-mark-id" value="{{$participantMark -> id}}">
                                        {{-- <a href="#my-modal" class="btn btn-primary">open modal</a>  --}}
                                        {{-- <input type="checkbox" id="my-modal-2" class="modal-toggle" >  --}}
                                        <div id="add-marks" class="modal">
                                        <div class="modal-box ">
                                                <p class="mb-2">Markah</p>
                                            <div class="flex text-center">
                                                <div class="">
                                                <input name="judge-1" class=" w-12 mx-1 rounded-lg @error('judge-1') border-red-700 @enderror" value="{{old('judge-1')}}" autofocus type="text" required></input>
                                                </div>
                                                 <div class="">
                                                <input name="judge-2" class=" w-12 mx-1 rounded-lg @error('judge-2') border-red-700 @enderror" value="{{old('judge-2')}}" type="text" required></input>
                                                </div>
                                                 <div class="">
                                                <input name="judge-3" class=" w-12 mx-1 rounded-lg @error('judge-3') border-red-700 @enderror" value="{{old('judge-3')}}" type="text" required></input>
                                                </div>
                                                 <div class="">
                                                <input name="judge-4" class=" w-12 mx-1 rounded-lg @error('judge-4') border-red-700 @enderror" value="{{old('judge-4')}}" type="text" required></input>
                                                </div>
                                                 <div class="">
                                                <input name="judge-5" class=" w-12 mx-1 rounded-lg @error('judge-5') border-red-700 @enderror" value="{{old('judge-5')}}" type="text" required></input>
                                                </div>
                                                 <div class="">
                                                <input name="judge-6" class=" w-12 mx-1 rounded-lg @error('judge-6') border-red-700 @enderror" value="{{old('judge-6')}}" type="text" required></input>
                                                </div>
                                                 <div class="">
                                                <input name="judge-7" class=" w-12 mx-1 rounded-lg @error('judge-7') border-red-700 @enderror" value="{{old('judge-7')}}" type="text" required></input>
                                                </div>
                                            </div>
                                            <div class="divider"></div> 
                                            <div class="flex">
                                                <div class="">
                                                    <p>Kesukaran</p>
                                                <input name="difficulty" class="w-1/2 @error('difficulty') border-red-700 @enderror" value="{{old('difficulty')}}" type="text" required></input>
                                                </div>
                                                <div class="">
                                                    <p>Penalti</p>
                                                <input name="penalty" class="w-1/2 @error('penalty') border-red-700 @enderror" value="{{old('penalty') ?? 0}}" type="text" required></input>
                                                </div>
                                            </div>
                                  
                                            <div class="modal-action">
                                            <button type="submit" for="my-modal-2" class="btn btn-primary">Tambah</button> 
                                    </form>
                                            @if($errors->any())
                                                <a href="" class="btn">Tutup</a>
                                            @else
                                                <a href="#close" class="btn">Tutup</a>
                                            @endif
                                            </div>
                                        </div>
                                        </div>

                                    @endcannot
                                </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</x-app-layout>
