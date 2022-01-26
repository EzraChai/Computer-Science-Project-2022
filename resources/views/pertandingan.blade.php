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
                        <svg class="w-8 h-8 absolute right-[-30px] top-1/4" xmlns="http://www.w3.org/2000/svg" style="background-color: rgb(255, 255, 255);" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="478px" height="373px" viewBox="-0.5 -0.5 478 373" content="&lt;mxfile host=&quot;app.diagrams.net&quot; modified=&quot;2022-01-25T10:54:33.788Z&quot; agent=&quot;5.0 (X11)&quot; etag=&quot;46wqFDQHFPkLieO3Ljtl&quot; version=&quot;16.4.6&quot;&gt;&lt;diagram id=&quot;jFGhsuhd7ZXjJS3TEQbm&quot; name=&quot;Page-1&quot;&gt;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&lt;/diagram&gt;&lt;/mxfile&gt;"><defs><clipPath id="mx-clippath-inset-0-0-15-7-0-1" clipPathUnits="objectBoundingBox"><rect x="0" y="0" width="1" height="0.843"/></clipPath></defs><g><image x="-0.5" y="-0.5" width="476.67" height="440.1045670225386" xlink:href="data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjYwNi4zMzQxMDY0NDUzMTI1IiBoZWlnaHQ9IjU1OS4zMDMyMjI2NTYyNSIgdmlld0JveD0iNDYuNTYyNzMyNjk2NTMzMiA3MC4zOTY3NTkwMzMyMDMxMiA2MDYuMzM0MTA2NDQ1MzEyNSA1NTkuMzAzMjIyNjU2MjUiIHByZXNlcnZlQXNwZWN0UmF0aW89InhNaWRZTWlkIG1lZXQiPiYjeGE7JiN4YTs8ZyB0cmFuc2Zvcm09InRyYW5zbGF0ZSgwLjAwMDAwMCw3MDAuMDAwMDAwKSBzY2FsZSgwLjEwMDAwMCwtMC4xMDAwMDApIiBmaWxsPSIjMDAwMDAwIiBzdHJva2U9Im5vbmUiPiYjeGE7PHBhdGggZD0iTTM3MTAgNjI4NCBjLTM2OCAtODAgLTc0MyAtMzcyIC0xMDgwIC04NDQgLTE5OCAtMjc3IC0zODUgLTY1MCAtNDU2JiN4QTstOTEwIC0xOCAtNjkgLTQ2IC0xOTIgLTUwIC0yMjUgLTMgLTIyIC03IC00NiAtOSAtNTIgLTMgLTcgLTcgLTU3IC0xMSAtMTEwJiN4QTstOCAtMTI0IDcgLTIwNCA1NSAtMzA4IDc0IC0xNTcgMjAyIC0yNjIgMzk2IC0zMjMgMTEgLTQgNTU0IC04IDEyMDYgLTkgMTE0NSYjeEE7LTMgMTE4OCAtMyAxMjMxIDE2IDE2MCA2OCAxOTEgMjgzIDU4IDM5NSAtNTYgNDYgLTExMiA1NCAtMzY4IDUzIC0xMjkgLTEmI3hBOy0yMzcgMCAtMjQxIDMgLTQgMyAtOCA0MTIgLTggOTEwIDAgODEyIC0yIDkxMiAtMTcgOTcwIC01MiAyMDEgLTE4NyAzNTAgLTM3OCYjeEE7NDE3IC04OSAzMSAtMjI5IDM4IC0zMjggMTd6IG0tMTQgLTE2MTcgYzIgLTM1IDE1IC0xNTkgMTkgLTE5MiAyIC0xNiA5IC03NyYjeEE7MTUgLTEzNSA2IC01OCAxMyAtMTIxIDE1IC0xNDAgMiAtMTkgNyAtNjIgMTAgLTk1IDMgLTMzIDggLTc3IDExIC05NyA1IC0zMiAzJiN4QTstMzggLTEzIC0zOSAtMTAgLTEgLTEyMyAtMiAtMjUwIC0zIC0xNjUgLTEgLTIzMyAyIC0yMzMgMTAgMCA0MyAxNDMgMzI4IDI0MiYjeEE7NDgyIDgwIDEyNSAxNjkgMjQ0IDE3NyAyMzcgMyAtMyA2IC0xNiA3IC0yOHoiLz4mI3hhOzxwYXRoIGQ9Ik0yMTA5IDMyNTYgYy00MCAtNyAtMTAxIC0yOSAtMTUwIC01MyAtMjA2IC0xMDIgLTMzMyAtMzEzIC0zMjMgLTUzNSYjeEE7MiAtNDAgNSAtODAgNyAtODggMiAtOCA3IC0zMSAxMSAtNTAgMTggLTc4IDgwIC0xODQgMTUxIC0yNTYgMjY4IC0yNzAgNzE1JiN4QTstMjE1IDkxMSAxMTMgODUgMTQyIDEwNSAzMTkgNTMgNDgyIC0yMyA3NCAtODQgMTY3IC0xNTAgMjMyIC0xMzYgMTMzIC0zMTYmI3hBOzE4NyAtNTEwIDE1NXoiLz4mI3hhOzxwYXRoIGQ9Ik0zODc0IDMwMjkgYy01IC05IDAgLTY4IDIxIC0yNTQgMyAtMjIgNyAtNjkgMTEgLTEwNSAzIC0zNiA3IC03NiAxMCYjeEE7LTkwIDIgLTE0IDYgLTU2IDEwIC05NSAzIC0zOCA3IC03OSA5IC05MSAyIC0xMSA2IC01MiAxMCAtOTAgMyAtMzggOCAtODIgMTAmI3hBOy05OSAyIC0xNiA3IC01OSAxMSAtOTUgMTEgLTExNSA1NiAtMTg0IDE0MyAtMjIzIDExNSAtNTEgMjUxIDQgMzA0IDEyMyAxOSA0MyYjeEE7MjAgNjYgMjEgNTMzIDEgMjY4IC0xIDQ4NyAtNCA0ODggLTI1IDUgLTU1MyAyIC01NTYgLTJ6Ii8+JiN4YTs8cGF0aCBkPSJNNjAyIDEzODAgYy0xNDggLTY4IC0xODMgLTI1OSAtNjggLTM3NSAzMCAtMzAgNzMgLTU0IDE2MSAtOTIgMTA2JiN4QTstNDUgMjgzIC0xMDkgMzI1IC0xMTggOCAtMiA0OSAtMTIgOTAgLTIzIDk5IC0yNyAxOTggLTQ2IDMwNSAtNTkgODAgLTEwIDM2MiYjeEE7LTEwIDQ0OSAwIDk1IDEwIDI5MCA1MSAzOTQgODMgOTcgMjkgMjYyIDkyIDI3NiAxMDUgMTcgMTUgNDEgMTAgMTE2IC0yMiAxMjUmI3hBOy01MyAyNzIgLTEwMSAzODUgLTEyNSAxODIgLTQwIDI4NyAtNTEgNDY1IC01MSAyODIgMCA1MzQgNDkgODA5IDE1OSBsMTIzIDUwJiN4QTsxMzAgLTUyIGMxMTMgLTQ0IDI1OCAtOTAgMzM4IC0xMDYgMTQgLTMgNDQgLTkgNjcgLTE0IDIyIC01IDY1IC0xMyA5NSAtMTYgMjkmI3hBOy0zIDc2IC0xMCAxMDMgLTE0IDU0IC05IDM3NSAtNiA0NDAgNCAyMDEgMzEgNDc5IDEwMyA2MDAgMTU2IDExIDUgNjIgMjcgMTEyJiN4QTs0OSA1MSAyMiAxMDkgNTIgMTI5IDY4IDc2IDU3IDEwNSAxODIgNjUgMjc2IC0yNCA1NSAtNTIgODMgLTExNSAxMTMgLTcwIDMzJiN4QTstMTM5IDI4IC0yNDEgLTE3IC0xMTEgLTUwIC0zMzAgLTEyNCAtNDI1IC0xNDQgLTE3OSAtMzkgLTI0NSAtNDcgLTM3MCAtNDUmI3hBOy0xMzMgMSAtMTY2IDUgLTM1NSA0NCAtOTYgMjAgLTM3OCAxMTcgLTQ1OSAxNTggLTIzIDEyIC02NiAyMiAtMTAwIDIzIC01MCAzJiN4QTstNzMgLTIgLTEzMSAtMjYgLTM4IC0xNyAtOTUgLTQwIC0xMjUgLTUxIC0zMCAtMTAgLTY0IC0yMyAtNzUgLTI4IC01NCAtMjMmI3hBOy0yMjQgLTcwIC0zMjcgLTkxIC0xMzEgLTI2IC0xNjkgLTMwIC0yOTMgLTI5IC0xMDYgMSAtMTM2IDMgLTIwMCAxNCAtMTYgMyYjeEE7LTQ2IDggLTY1IDExIC0xMTggMjAgLTMzOCA4OCAtNDg4IDE1MiAtMTU5IDY3IC0xODAgNjcgLTM1MCAtMSAtMjk3IC0xMTkmI3hBOy01NDIgLTE3NyAtNzQ5IC0xNzggLTIzMyAtMSAtNDk3IDY0IC04MzUgMjA1IC03MyAzMCAtMTQ5IDMzIC0yMDYgN3oiLz4mI3hhOzwvZz4mI3hhOzwvc3ZnPg==" preserveAspectRatio="none" clip-path="url(#mx-clippath-inset-0-0-15-7-0-1)"/></g></svg>
                        <svg class="absolute -bottom-8 opacity-20 left-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#05b2cf" fill-opacity="1" d="M0,192L40,208C80,224,160,256,240,261.3C320,267,400,245,480,218.7C560,192,640,160,720,170.7C800,181,880,235,960,213.3C1040,192,1120,96,1200,64C1280,32,1360,64,1400,80L1440,96L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z"></path></svg>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    <div class="py-20"></div>
    <script>
        function handleHover(e){
            // let tl = gsap.timeline(); //create the timeline

             gsap.to(e.target.children[0].children[e.target.children[0].childElementCount - 1],{
                y: -32,
                delay: .15,
                duration: .6,
                ease: "power3.out"
            })
            if (!gsap.isTweening(e.target.children[0].children[e.target.children[0].childElementCount - 2])) {
                gsap.to(e.target.children[0].children[e.target.children[0].childElementCount - 2],{
                x: 0,
                y:0,
                rotation:"135_short",
                delay: 0
            })
            }
         
            gsap.to(e.target.children[0].children[e.target.children[0].childElementCount - 2],{
                x: -40,
                y: 75,
                rotation:"315_ccw",
                delay: .3,
                duration: .5,
                ease: "power3.out"
            })
        }

        function handleHoverOut(e){
        

            let tl = gsap.timeline(); //create the timeline

                tl.to(e.target.children[0].children[e.target.children[0].childElementCount - 2],{
                x: 0,
                y: 150,
                rotation:"270_ccw",
                duration: .6,
                delay: .15,
                ease: "power3.in"
            }).to(e.target.children[0].children[e.target.children[0].childElementCount - 2],{
                x: 0,
                y: 0,
                })
                    gsap.to(e.target.children[0].children[e.target.children[0].childElementCount - 1],{
                y: 0,
                duration: .6,
                ease: "power3.in"
            })
            }
            
    </script>
</x-public-page>
