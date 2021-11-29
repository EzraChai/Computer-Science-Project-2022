<x-public-page>
    <div class="p-12"></div>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-row w-full">
                <div class="grid grid-cols-1 gap-6 lg:p-10 xl:grid-cols-3 w-full rounded-box">
                    <div class="card transform hover:-translate-y-2 transition shadow-lg side col-span-2  bg-base-100">
                        <div class="flex-row items-center space-x-4 card-body">
                            <div class="flex-1">
                                <p class="text-base-content text-opacity-60">Tajuk Pertandingan</p>
                                <h1 class="card-title text-YInMnBlue text-font-2 font-extrabold text-4xl">{{$competition-> name}}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="card transform hover:-translate-y-2 transition shadow-lg side col-span-1 bg-base-100">
                        <div class="flex-row items-center space-x-4 card-body">
                            <div class="flex-1">
                                <p class="text-base-content text-opacity-60">Tarikh Pertandingan</p>
                                <h1 class="card-title text-4xl font-extrabold text-YInMnBlue">{{date('d/m/Y',strtotime($competition-> date))}}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="card transform hover:-translate-y-2 transition shadow-lg side col-span-2  bg-base-100">
                        <div class="flex-row items-center space-x-4 card-body">
                            <div class="flex-1">
                                <p class="text-base-content text-opacity-60">Tempat Pertandingan</p>
                                <h1 class="card-title text-4xl font-extrabold text-YInMnBlue">{{$competition-> avenue}}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="card transform hover:-translate-y-2 transition shadow-lg side col-span-1 bg-base-100">
                        <div class="flex-row items-center space-x-4 card-body">
                            <div class="flex-1">
                                <p class="text-base-content text-opacity-60">Jumlah Bilangan Peserta</p>
                                <h1 class="card-title text-4xl font-extrabold text-YInMnBlue">{{$participantsCount}}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="card col-span-1 row-span-3 shadow-lg xl:col-span-3 bg-base-100">
                        <div class="card-body text-gray-800">
                            @foreach ($overallParticipantsMark as $key => $participantsMark)
                            <div class="collapse w-full mt-4 shadow-sm collapse-arrow">
                                <input type="checkbox"/> 
                                <div class="collapse-title text-xl font-medium">
                                    Pusingan ke-{{$key + 1}}
                                </div> 
                                <div class="collapse-content"> 
                                    <table class="table w-full">
                                        <thead>
                                            <tr>
                                                <th></th> 
                                                <th>Nama</th> 
                                                <th>Pemarkahan</th> 
                                                <th>Markah</th>
                                                <th>Jumlah Markah</th>
                                            </tr>
                                        </thead> 
                                        <tbody>
                                            @foreach ($participantsMark as $key => $participantMark)
                                            <tr>
                                                <th>{{$key + 1}}</th> 
                                                <td>{{$participantMark -> peserta -> name}}</td> 
                                                <td>
                                                    <div class="flex">
                                                        <div class="flex width-20 @if($participantMark -> marks == 0 ) hidden @endif">
                                                        <div class="border border-gray-400 rounded-box px-1 mx-1 ">
                                                        {{number_format((float)$participantMark -> judge_1,1)}}
                                                        </div>
                                                        <div class="border border-gray-400 rounded-box px-1 mx-1">
                                                        {{number_format((float)$participantMark -> judge_2,1)}}
                                                        </div>
                                                        <div class="border border-gray-400 rounded-box px-1 mx-1">
                                                        {{number_format((float)$participantMark -> judge_3,1)}}
                                                        </div>
                                                        <div class="border border-gray-400 rounded-box px-1 mx-1">
                                                        {{number_format((float)$participantMark -> judge_4,1)}}
                                                        </div>
                                                        <div class="border border-gray-400 rounded-box px-1 mx-1">
                                                        {{number_format((float)$participantMark -> judge_5,1)}}
                                                        </div>
                                                        <div class="border border-gray-400 rounded-box px-1 mx-1">
                                                        {{number_format((float)$participantMark -> judge_6,1)}}
                                                        </div>
                                                        <div class="border border-gray-400 rounded-box px-1 mx-1">
                                                        {{number_format((float)$participantMark -> judge_7,1)}}
                                                        </div>
                                                    </div>
                                                    <div class="">
                                                        <div class="flex mx-3 items-center @if($participantMark -> marks == 0 ) hidden @endif">
                                                            <div class="text-2xs mx-1">
                                                                KESUKARAN
                                                            </div>
                                                            <div class="border border-gray-400 rounded-box px-1">
                                                        {{number_format((float)$participantMark -> difficulty,1)}}
                                                        </div>
                                                        <div class="flex mx-3 items-center">
                                                            <div class="text-2xs mx-1">
                                                                PENALTI
                                                            </div>
                                                            <div class="border border-gray-400 rounded-box px-1">
                                                        {{number_format((float)$participantMark -> penalty,1)}}
                                                        </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    
                                                </td> 
                                                <td>
                                                    <div class="@if($participantMark -> marks == 0) hidden @endif">
                                                        {{$participantMark -> marks}}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="@if($participantMark -> total_marks == 0) hidden @endif">
                                                        {{$participantMark -> total_marks}}
                                                    </div>
                                                </td>
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
    <div class="p-10"></div>
</x-public-page>
