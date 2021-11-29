<x-public-page>
        <div class="py-12 min-h-16">
        <div class="py-20"></div>
              <h1 class="text-5xl text-font text-center mb-16 splitText">Pertandingan</h1>
                <div class="max-w-7xl mx-auto lg:px-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                    @foreach ($competitions as $competition)
                    <a href="/competition/{{$competition->id}}" class="card shadow-2xl lg:card-side bg-white text-primary-content transform transition hover:-translate-y-3">
                      <div class="card-body">
                        <h1 class=" text-xl text-font-2">{{$competition -> name}}</h1> 
                        <p class="text-base text-gray-500">{{$competition -> avenue}}</p>
                        
                        <p class="text-base mt-2 text-gray-600">Peserta yang terlibat:</p>
                        <ul class="margintop-half">
                            @foreach ($competition ->participantName  as $item)
                            <li class="text-gray-500 text-sm">
                                 - {{$item}}
                            </li>
                            @endforeach
                        </ul>
                      </div>
                    </a> 
                    @endforeach
                  </div>
              </div>
            <div class="py-20"></div>
</x-public-page>