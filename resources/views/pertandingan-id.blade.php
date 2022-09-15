<x-public-page>
    <div class="p-12"></div>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-row w-full">
                <div data-scroll-section class="grid grid-cols-1 gap-6 lg:p-10 xl:grid-cols-3 w-full rounded-box">
                    <div class="card transform hover:-translate-y-2 transition shadow-lg side col-span-2  bg-base-100">
                        <div class="flex-row items-center space-x-4 card-body">
                            <div class="flex-1">
                                <p class="text-base-content text-opacity-60">Pertandingan</p>
                                <h1 class="card-title text-YInMnBlue font-extrabold text-4xl">
                                    {{ $competition->name }}
                                </h1>
                            </div>
                        </div>
                    </div>
                    <div class="card transform hover:-translate-y-2 transition shadow-lg side col-span-1 bg-base-100">
                        <div class="flex-row items-center space-x-4 card-body">
                            <div class="flex-1">
                                <p class="text-base-content text-opacity-60">Tarikh</p>
                                <h1 class="card-title text-4xl font-extrabold text-YInMnBlue">
                                    {{ date('d/m/Y', strtotime($competition->date)) }}
                                </h1>
                            </div>
                        </div>
                    </div>
                    <div class="card transform hover:-translate-y-2 transition shadow-lg side col-span-2  bg-base-100">
                        <div class="flex-row items-center space-x-4 card-body">
                            <div class="flex-1">
                                <p class="text-base-content text-opacity-60">Tempat</p>
                                <h1 class="card-title text-4xl font-extrabold text-YInMnBlue">
                                    {{ $competition->avenue }}
                                </h1>
                            </div>
                        </div>
                    </div>
                    <div class="card transform hover:-translate-y-2 transition shadow-lg side col-span-1 bg-base-100">
                        <div class="flex-row items-center space-x-4 card-body">
                            <div class="flex-1">
                                <p class="text-base-content text-opacity-60">Jumlah Bilangan Peserta</p>
                                <h1 class="card-title text-4xl font-extrabold text-YInMnBlue">
                                    {{ $participantsCount }}
                                </h1>
                            </div>
                        </div>
                    </div>
                    @if (count($lastFirstThreeParticipantMark) > 2)
                        @if ($lastFirstThreeParticipantMark[2]->total_marks != 0)
                            <div class="card col-span-1 p-8 row-span-3 shadow-lg xl:col-span-3 bg-base-100">
                                <table class="table w-full table-zebra">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Peserta</th>
                                            <th>Asal</th>
                                            <th>Jumlah Markah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($lastFirstThreeParticipantMark as $key3 => $participantMark)
                                            <tr>
                                                <td class="w-14">
                                                    @if ($key3 + 1 == 1)
                                                        <img class="w-full h-full"
                                                            src="https://cdn-icons-png.flaticon.com/128/2583/2583344.png"
                                                            alt="Gold Medal">
                                                    @elseif($key3 + 1 == 2 )
                                                        <img class="w-full h-full"
                                                            src="https://cdn-icons-png.flaticon.com/512/2583/2583319.png"
                                                            alt="Silver Medal">
                                                    @else
                                                        <img class="w-full h-full"
                                                            src="https://cdn-icons-png.flaticon.com/512/2583/2583434.png"
                                                            alt="Bronze Medal">
                                                    @endif
                                                </td>
                                                @if ($competition->type == 'Seirama')
                                                    <td>{{ $participantMark->peserta->name }} <br>
                                                        {{ $participantMark->peserta->secondName }}</td>
                                                @else
                                                    <td>{{ $participantMark->peserta->name }}</td>
                                                @endif
                                                <td>{{ $participantMark->peserta->school }}</td>
                                                <td>{{ $participantMark->total_marks }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    @endif

                    <div class="card col-span-1 row-span-3 shadow-lg xl:col-span-3 bg-base-100">
                        <div class="card-body text-gray-800">
                            @foreach ($overallParticipantsMark as $key2 => $participantsMark)
                                <div class="collapse w-full mt-4 shadow-sm collapse-arrow">
                                    <input onclick="handleClick()" type="checkbox" />
                                    <div class="collapse-title text-xl font-medium">
                                        Pusingan ke-{{ $key2 + 1 }}
                                    </div>
                                    <div class="collapse-content">
                                        <table class="table w-full">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Peserta</th>
                                                    <th>Pemarkahan</th>
                                                    <th>Markah</th>
                                                    <th>Jumlah Markah</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($participantsMark as $key => $participantMark)
                                                    @if ($competition->type == 'Seirama')
                                                        <tr>
                                                            @if ($key + 1 == 1 && $key2 + 1 == 5 && $participantMark->total_marks != 0)
                                                                <th><img class="w-7 h-7"
                                                                        src="https://cdn-icons-png.flaticon.com/128/2583/2583344.png"
                                                                        alt="Gold Medal"></th>
                                                            @elseif($key + 1 == 2 && $key2 + 1 == 5 &&
                                                                $participantMark -> total_marks != 0)
                                                                <th><img class="w-7 h-7"
                                                                        src="https://cdn-icons-png.flaticon.com/512/2583/2583319.png"
                                                                        alt="Silver Medal"></th>
                                                            @elseif($key + 1 == 3 && $key2 + 1 == 5 &&
                                                                $participantMark -> total_marks != 0)
                                                                <th><img class="w-7 h-7"
                                                                        src="https://cdn-icons-png.flaticon.com/512/2583/2583434.png"
                                                                        alt="Bronze Medal"></th>
                                                            @else
                                                                <th>
                                                                    <div class="ml-2">{{ $key + 1 }}
                                                                    </div>
                                                                </th>
                                                            @endif
                                                            <td>{{ $participantMark->peserta->name }} <br>
                                                                {{ $participantMark->peserta->secondName }}</td>
                                                            <td>
                                                                <div class="flex items-center">
                                                                    <div class="">
                                                                        <div
                                                                            class="text-2xs mx-1 uppercase @if ($participantMark->marks == 0) hidden @endif">
                                                                            Pelaksanaan
                                                                        </div>
                                                                        <div class="flex @if ($participantMark->marks == 0) hidden @endif">
                                                                            <div
                                                                                class="border border-gray-400 rounded-box px-1 mx-1 ">
                                                                                {{ number_format((float) $participantMark->judge_1, 1) }}
                                                                            </div>
                                                                            <div
                                                                                class="border border-gray-400 rounded-box px-1 mx-1">
                                                                                {{ number_format((float) $participantMark->judge_2, 1) }}
                                                                            </div>
                                                                            <div
                                                                                class="border border-gray-400 rounded-box px-1 mx-1">
                                                                                {{ number_format((float) $participantMark->judge_3, 1) }}
                                                                            </div>
                                                                            <div
                                                                                class="border border-gray-400 rounded-box px-1 mx-1">
                                                                                {{ number_format((float) $participantMark->judge_4, 1) }}
                                                                            </div>
                                                                            <div
                                                                                class="border border-gray-400 rounded-box px-1 mx-1">
                                                                                {{ number_format((float) $participantMark->judge_5, 1) }}
                                                                            </div>
                                                                            <div
                                                                                class="border border-gray-400 rounded-box px-1 mx-1">
                                                                                {{ number_format((float) $participantMark->judge_6, 1) }}
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="text-2xs mt-2 mx-1 uppercase @if ($participantMark->marks == 0) hidden @endif">
                                                                            Sinkronisasi
                                                                        </div>
                                                                        <div class="flex @if ($participantMark->marks == 0) hidden @endif">

                                                                            <div
                                                                                class="border border-gray-400 rounded-box px-1 mx-1 ">
                                                                                {{ number_format((float) $participantMark->sync_1, 1) }}
                                                                            </div>
                                                                            <div
                                                                                class="border border-gray-400 rounded-box px-1 mx-1">
                                                                                {{ number_format((float) $participantMark->sync_2, 1) }}
                                                                            </div>
                                                                            <div
                                                                                class="border border-gray-400 rounded-box px-1 mx-1">
                                                                                {{ number_format((float) $participantMark->sync_3, 1) }}
                                                                            </div>
                                                                            <div
                                                                                class="border border-gray-400 rounded-box px-1 mx-1">
                                                                                {{ number_format((float) $participantMark->sync_4, 1) }}
                                                                            </div>
                                                                            <div
                                                                                class="border border-gray-400 rounded-box px-1 mx-1">
                                                                                {{ number_format((float) $participantMark->sync_5, 1) }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="">
                                                                        <div
                                                                            class="flex mx-3 items-center @if ($participantMark->marks == 0) hidden @endif">
                                                                            <div class="text-2xs mx-1">
                                                                                KESUKARAN
                                                                            </div>
                                                                            <div
                                                                                class="border border-gray-400 rounded-box px-1">
                                                                                {{ number_format((float) $participantMark->difficulty, 1) }}
                                                                            </div>
                                                                            <div class="flex mx-3 items-center">
                                                                                <div class="text-2xs mx-1">
                                                                                    PENALTI
                                                                                </div>
                                                                                <div
                                                                                    class="border border-gray-400 rounded-box px-1">
                                                                                    {{ number_format((float) $participantMark->penalty, 1) }}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                            </td>
                                                            <td>
                                                                <div class="@if ($participantMark->marks == 0) hidden @endif">
                                                                    {{ $participantMark->marks }}
                                                                </div>
                                                            <td>
                                                                <div class="@if ($participantMark->total_marks == 0) hidden @endif">
                                                                    {{ $participantMark->total_marks }}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @else
                                                        <tr>
                                                            @if ($key + 1 == 1 && $key2 + 1 == 5 && $participantMark->total_marks != 0)
                                                                <th><img class="w-6 h-6"
                                                                        src="https://cdn-icons-png.flaticon.com/128/2583/2583344.png"
                                                                        alt="Gold Medal"></th>
                                                            @elseif($key + 1 == 2 && $key2 + 1 == 5 &&
                                                                $participantMark -> total_marks != 0)
                                                                <th><img class="w-6 h-6"
                                                                        src="https://cdn-icons-png.flaticon.com/512/2583/2583319.png"
                                                                        alt="Silver Medal"></th>
                                                            @elseif($key + 1 == 3 && $key2 + 1 == 5 &&
                                                                $participantMark -> total_marks != 0)
                                                                <th><img class="w-6 h-6"
                                                                        src="https://cdn-icons-png.flaticon.com/512/2583/2583434.png"
                                                                        alt="Bronze Medal"></th>
                                                            @else
                                                                <th>
                                                                    <div class="">{{ $key + 1 }}
                                                                    </div>
                                                                </th>
                                                            @endif
                                                            <td class="w-10">
                                                                {{ $participantMark->peserta->name }}</td>
                                                            <td class="relative">
                                                                <div class="">
                                                                    <div class="flex @if ($participantMark->marks == 0) hidden @endif">
                                                                        <div
                                                                            class="border border-gray-400 rounded-box px-1 mx-1 ">
                                                                            {{ number_format((float) $participantMark->judge_1, 1) }}
                                                                        </div>
                                                                        <div
                                                                            class="border border-gray-400 rounded-box px-1 mx-1">
                                                                            {{ number_format((float) $participantMark->judge_2, 1) }}
                                                                        </div>
                                                                        <div
                                                                            class="border border-gray-400 rounded-box px-1 mx-1">
                                                                            {{ number_format((float) $participantMark->judge_3, 1) }}
                                                                        </div>
                                                                        <div
                                                                            class="border border-gray-400 rounded-box px-1 mx-1">
                                                                            {{ number_format((float) $participantMark->judge_4, 1) }}
                                                                        </div>
                                                                        <div
                                                                            class="border border-gray-400 rounded-box px-1 mx-1">
                                                                            {{ number_format((float) $participantMark->judge_5, 1) }}
                                                                        </div>
                                                                        <div
                                                                            class="border border-gray-400 rounded-box px-1 mx-1">
                                                                            {{ number_format((float) $participantMark->judge_6, 1) }}
                                                                        </div>
                                                                        <div
                                                                            class="border border-gray-400 rounded-box px-1 mx-1">
                                                                            {{ number_format((float) $participantMark->judge_7, 1) }}
                                                                        </div>
                                                                    </div>
                                                                    <div class="mt-2">
                                                                        <div
                                                                            class="flex items-center @if ($participantMark->marks == 0) hidden @endif">
                                                                            <div class="text-2xs mx-1">
                                                                                KESUKARAN
                                                                            </div>
                                                                            <div
                                                                                class="border border-gray-400 rounded-box px-1">
                                                                                {{ number_format((float) $participantMark->difficulty, 1) }}
                                                                            </div>
                                                                            <div class="flex mx-3 items-center">
                                                                                <div class="text-2xs mx-1">
                                                                                    PENALTI
                                                                                </div>
                                                                                <div
                                                                                    class="border border-gray-400 rounded-box px-1">
                                                                                    {{ number_format((float) $participantMark->penalty, 1) }}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                            </td>
                                                            <td>
                                                                <div class="@if ($participantMark->marks == 0) hidden @endif">
                                                                    {{ $participantMark->marks }}
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="@if ($participantMark->total_marks == 0) hidden @endif">
                                                                    {{ $participantMark->total_marks }}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endif
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
    <script>
        const handleClick = () => {
            scroll.update()
        }
    </script>
</x-public-page>
