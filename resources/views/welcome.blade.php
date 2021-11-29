
<x-public-page>
      <div class="min-h-screen bg-base-200">
        <div class="text-center">
          <div class="w-full">
            <div class="cursor"></div>
            <div class="shapes">
              <div class="shape shape-1"></div>
              <div class="shape shape-2"></div>
              <div class="shape shape-3"></div>
            </div>
            <div class="content">
              <div class="texthere">
              <h1 class=" text-9xl font-extrabold">Pertandingan Terjun</h1>
              <h1 class=" illusion opacity-25 text-9xl font-extrabold">Pertandingan Terjun</h1>
              </div>
            </div>
          </div>
        </div>
      </div>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
          <path fill="#fff" fill-opacity="1" d="M0,320L30,288C60,256,120,192,180,176C240,160,300,192,360,202.7C420,213,480,203,540,176C600,149,660,107,720,85.3C780,64,840,64,900,85.3C960,107,1020,149,1080,176C1140,203,1200,213,1260,197.3C1320,181,1380,139,1410,117.3L1440,96L1440,0L1410,0C1380,0,1320,0,1260,0C1200,0,1140,0,1080,0C1020,0,960,0,900,0C840,0,780,0,720,0C660,0,600,0,540,0C480,0,420,0,360,0C300,0,240,0,180,0C120,0,60,0,30,0L0,0Z" style="--darkreader-inline-fill: #0074c2;" data-darkreader-inline-fill=""></path>
        </svg>
            <div id="pertandingan" class="py-12">
              <h1 class="text-5xl text-font text-center mb-16 splitText text-font-2">Pertandingan</h1>
                <div class="max-w-7xl mx-auto lg:px-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                    @foreach ($competitions as $competition)
                    <a href="/competition/{{$competition->id}}" class="card shadow-2xl lg:card-side bg-white text-primary-content transform transition hover:-translate-y-3">
                      <div class="card-body">
                        <h1 class="text-font-2 text-xl">{{$competition -> name}}</h1> 
                        <p class="text-base text-gray-500">{{$competition -> avenue}}</p> 
                      </div>
                    </a> 
                    @endforeach
                  </div>
                  
                  <div class="flex py-2 justify-center">
                    <a href="/competition" class="link mt-12 font-bold link-hover text-2xl">Pertandingan Lain &#8594;</a>
                    <!-- <div class="btn mt-10">
                      <div class="flex items-center">
                        <div>Maklumat Lanjut</div> 
                        <div class="ml-2">&#8594;</div>
                    </div></div>
                  </div> -->
              </div>
              <div class="py-20"></div>
          </div>
    </div>
</div>
<script>

  document.body.addEventListener("mousemove",event => {
    const mouseX = event.clientX;
    const mouseY = event.clientY;

    gsap.set(".cursor", {
      x:mouseX,
      y:mouseY
    })

    gsap.to(".shape", {
        x: mouseX,
        y: mouseY,
        stagger: -0.1
    })
  })
</script>
</x-public-page>
