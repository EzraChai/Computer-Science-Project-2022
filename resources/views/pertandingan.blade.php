<x-public-page>
        <div class="py-12 min-h-16">
        <div class="py-12"></div>
        <div class="max-w-2xl m-auto">
            <form action="/search/query" method="GET">
                @csrf
                <div class=" mb-24 form-control">
                    <div class="flex space-x-2">
                        <input type="text" name="search" placeholder="Tajuk Pertandingan / Nama Peserta" class="w-full input input-neutral-focus input-bordered" required value="{{$text ?? ""}}"> 
                        <button class="btn  bg-YInMnBlue text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-6 h-6 stroke-current">             
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>             
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
        </div>
              <h1 class="text-5xl text-font text-center mb-16 splitText text-font-2">Pertandingan</h1>
                    @if(count($competitions) == 0 )
                        <div class="text-center text-xl mb-12 text-gray-700">😥 Opps... Pertandingan yang anda ingin cari tidak dapat dicari.</div>
                    @endif

                <div class="max-w-7xl mx-auto lg:px-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                    
                    @foreach ($competitions as $competition)
                    <a href="/competition/{{$competition->id}}" class="card shadow-2xl lg:card-side bg-white text-primary-content transform transition hover:-translate-y-3">
                      <div class="card-body">
                        <h1 class=" text-xl text-font-2">{{$competition -> name}}</h1> 
                            <p class="text-base text-gray-500">{{$competition -> avenue}}</p>
                        <p class="text-base mt-2 text-gray-600">Peserta yang terlibat:</p>
                        <ul class="margintop-half">
                            @foreach ($competition -> participantName  as $item)
                            <li class="text-gray-500 text-sm">
                                 - {{$item ->name}}
                                @if($competition -> type == "Seirama") / {{$item -> secondName}} @endif
                            </li>
                            @endforeach
                        </ul>
                        <div class="flex justify-end">
                            <p class="text-base text-gray-500 ">{{$competition -> date}}</p>
                        </div>
                      </div>
                    </a> 
                    @endforeach
                  </div>
              </div>
            <div class="py-20"></div>
</x-public-page>