<x-public-page>
    <div class="py-12 min-h-16">
        <div class="py-12"></div>
        <div data-scroll-section class="max-w-2xl m-auto">
            <form data-scroll data-scroll-speed="-1.75" action="/competitions/query" method="GET">
                @csrf
                <div class=" mb-24 form-control">
                    <div class="flex space-x-2">
                        <input type="text" name="search" placeholder="Tajuk Pertandingan / Nama Peserta"
                            class="w-full input input-neutral-focus input-bordered" required value="{{ $text ?? '' }}">
                        <button class="btn  bg-YInMnBlue text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                class="inline-block w-6 h-6 stroke-current">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div data-scroll-section>
          <h1 data-scroll data-scroll-speed="-1" class="text-5xl text-font text-center mb-16 splitText text-font-2">Pertandingan</h1>
        @if (count($competitions) == 0)
            <div class="text-center text-xl mb-12 text-gray-700">😥 Opps... Pertandingan yang anda ingin cari tidak dapat
                dicari.</div>
        @endif

        </div>
      
        <div data-scroll-section class="max-w-7xl mx-auto lg:px-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">

            @foreach ($competitions as $competition)
                <a data-scroll href="/competitions/{{ $competition->id }}"
                    class="card shadow-2xl lg:card-side bg-white text-primary-content transform transition hover:scale-105" onmouseenter="handleHover(event)" onmouseleave="handleHoverOut(event)" >
                    <div class="card-body">
                        <h1 class=" text-xl text-font-2">{{ $competition->name }}</h1>
                        <p class="text-base text-gray-500">{{ $competition->avenue }}</p>
                        <p class="text-base mt-2 text-gray-600">Peserta yang terlibat:</p>
                        <ul class="margintop-half">
                            @foreach ($competition->participantName as $item)
                                <li class="text-gray-500 text-sm">
                                    - {{ $item->name }}
                                    @if ($competition->type == 'Seirama') / {{ $item->secondName }} @endif
                                </li>
                            @endforeach
                        </ul>
                        <div class="flex justify-end">
                            <p class="text-base text-gray-500 ">{{ $competition->date }}</p>
                        </div>
                        <svg class="absolute -bottom-8 opacity-20 left-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#05b2cf" fill-opacity="1" d="M0,192L40,208C80,224,160,256,240,261.3C320,267,400,245,480,218.7C560,192,640,160,720,170.7C800,181,880,235,960,213.3C1040,192,1120,96,1200,64C1280,32,1360,64,1400,80L1440,96L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z"></path></svg>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    <div class="py-20"></div>
    <script>
        function handleHover(e){
            gsap.to(e.target.children[0].children[e.target.children[0].childElementCount - 1],{
                y: -32,
                delay: .15,
                duration: .6,
                ease: "power3.out"
            })
        }

        function handleHoverOut(e){
            gsap.to(e.target.children[0].children[e.target.children[0].childElementCount - 1],{
                y: 0,
                duration: .6,
                ease: "power3.in"
            })
        }
    </script>
</x-public-page>
