<x-guest-layout>
    <header class="print:hidden">
        <div class="navbar navbar-settings left-0 top-4 shadow-xl fixed z-50 bg-neutral text-neutral-content rounded-box">
            <div class="px-2 mx-2 navbar-start">
                <div class="flex items-center">
                    <svg class=" fill-current mx-2 w-6 h-6" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 30 30">
                        <path d="M 16.5 3 A 2.5 2.5 0 0 0 16 3.0527344 C 12.718641 3.5621144 9.2004834 8.8687485 9.0175781 12.226562 A 2.5 2.5 0 0 0 9 12.5 A 2.5 2.5 0 0 0 11.404297 14.996094 A 1.0001 1.0001 0 0 0 11.5 15 L 17.832031 15 A 1.0001 1.0001 0 0 0 18.158203 15 L 21 15 A 1.0001 1.0001 0 1 0 21 13 L 19 13 L 19 6 L 19 5.5 A 2.5 2.5 0 0 0 18.996094 5.4003906 A 1.0001 1.0001 0 0 0 18.994141 5.3925781 A 2.5 2.5 0 0 0 16.5 3 z M 15.816406 9.8125 L 16.154297 13 L 13.982422 13 C 14.407679 11.839336 15.065609 10.773749 15.816406 9.8125 z M 9.5 16 A 2.5 2.5 0 0 0 7 18.5 A 2.5 2.5 0 0 0 9.5 21 A 2.5 2.5 0 0 0 12 18.5 A 2.5 2.5 0 0 0 9.5 16 z M 16.576172 17 L 17 21 A 1 1 0 0 0 18 22 A 1 1 0 0 0 19 21 L 19 17 L 16.576172 17 z M 2.9648438 23.994141 A 1.0001 1.0001 0 0 0 2.5527344 25.894531 C 2.5527344 25.894531 4.6666667 27 7 27 C 8.9465696 27 10.458804 26.333203 11 26.078125 C 11.541196 26.333203 13.05343 27 15 27 C 16.94657 27 18.458804 26.333203 19 26.078125 C 19.541196 26.333203 21.05343 27 23 27 C 25.333333 27 27.447266 25.894531 27.447266 25.894531 A 1.0001163 1.0001163 0 1 0 26.552734 24.105469 C 26.552734 24.105469 24.666667 25 23 25 C 21.333333 25 19.447266 24.105469 19.447266 24.105469 A 1.0001 1.0001 0 0 0 18.552734 24.105469 C 18.552734 24.105469 16.666667 25 15 25 C 13.333333 25 11.447266 24.105469 11.447266 24.105469 A 1.0001 1.0001 0 0 0 10.552734 24.105469 C 10.552734 24.105469 8.6666667 25 7 25 C 5.3333333 25 3.4472656 24.105469 3.4472656 24.105469 A 1.0001 1.0001 0 0 0 2.9648438 23.994141 z"></path></svg>
                    <div class="text-lg font-bold">
                        Terjun
                    </div>
                </div>
            </div> 
            <div class="hidden px-2 mx-2 navbar-center justify-center navbar-settings lg:flex">
                <div class="flex items-stretch">
                    <a href="/" class="btn btn-ghost btn-sm font-extrabold rounded-btn hover:text-cyan-400">
                        Utama
                    </a> 
                    <a href="/competitions" class="btn btn-ghost font-extrabold btn-sm rounded-btn hover:text-purple-400">
                        Pertandingan
                      </a> 
                    <a href="/dashboard" class="btn btn-ghost btn-sm font-extrabold rounded-btn hover:text-indigo-400">
                        Log Masuk
                      </a>
                </div>
            </div>
        </div>
        <div class="navbar-end">
        </div>
    </header>
    <main class="">
        {{ $slot }}
    </main>
    <footer data-scroll-section data-theme="dark" class="p-10 footer bg-base-300 text-primary-content footer-center print:hidden">
        <div>
            <svg class=" fill-current w-9 h-9 mt-2" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 30 30">
                <path d="M 16.5 3 A 2.5 2.5 0 0 0 16 3.0527344 C 12.718641 3.5621144 9.2004834 8.8687485 9.0175781 12.226562 A 2.5 2.5 0 0 0 9 12.5 A 2.5 2.5 0 0 0 11.404297 14.996094 A 1.0001 1.0001 0 0 0 11.5 15 L 17.832031 15 A 1.0001 1.0001 0 0 0 18.158203 15 L 21 15 A 1.0001 1.0001 0 1 0 21 13 L 19 13 L 19 6 L 19 5.5 A 2.5 2.5 0 0 0 18.996094 5.4003906 A 1.0001 1.0001 0 0 0 18.994141 5.3925781 A 2.5 2.5 0 0 0 16.5 3 z M 15.816406 9.8125 L 16.154297 13 L 13.982422 13 C 14.407679 11.839336 15.065609 10.773749 15.816406 9.8125 z M 9.5 16 A 2.5 2.5 0 0 0 7 18.5 A 2.5 2.5 0 0 0 9.5 21 A 2.5 2.5 0 0 0 12 18.5 A 2.5 2.5 0 0 0 9.5 16 z M 16.576172 17 L 17 21 A 1 1 0 0 0 18 22 A 1 1 0 0 0 19 21 L 19 17 L 16.576172 17 z M 2.9648438 23.994141 A 1.0001 1.0001 0 0 0 2.5527344 25.894531 C 2.5527344 25.894531 4.6666667 27 7 27 C 8.9465696 27 10.458804 26.333203 11 26.078125 C 11.541196 26.333203 13.05343 27 15 27 C 16.94657 27 18.458804 26.333203 19 26.078125 C 19.541196 26.333203 21.05343 27 23 27 C 25.333333 27 27.447266 25.894531 27.447266 25.894531 A 1.0001163 1.0001163 0 1 0 26.552734 24.105469 C 26.552734 24.105469 24.666667 25 23 25 C 21.333333 25 19.447266 24.105469 19.447266 24.105469 A 1.0001 1.0001 0 0 0 18.552734 24.105469 C 18.552734 24.105469 16.666667 25 15 25 C 13.333333 25 11.447266 24.105469 11.447266 24.105469 A 1.0001 1.0001 0 0 0 10.552734 24.105469 C 10.552734 24.105469 8.6666667 25 7 25 C 5.3333333 25 3.4472656 24.105469 3.4472656 24.105469 A 1.0001 1.0001 0 0 0 2.9648438 23.994141 z"></path></svg>
            <p class="font-bold text-lg">Sistem Pertandingan Terjun</p>
                <p class=" font-semibold text-md"> Direka oleh Ezra Chai <span class="text-red-700">&hearts;</span> </o>
            <p>Hakcipta © {{date("Y")}} - Semua Hak Terpelihara</p>
        </div> 
        <div >
            <div  class="grid grid-flow-col gap-4 items-center">
            <a data-scroll target="blank" title="Instagram" href="https://www.instagram.com/juanzhx_/">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20"><path fill="none" d="M0 0h24v24H0z"/><path fill="#ffffff" d="M12 2c2.717 0 3.056.01 4.122.06 1.065.05 1.79.217 2.428.465.66.254 1.216.598 1.772 1.153a4.908 4.908 0 0 1 1.153 1.772c.247.637.415 1.363.465 2.428.047 1.066.06 1.405.06 4.122 0 2.717-.01 3.056-.06 4.122-.05 1.065-.218 1.79-.465 2.428a4.883 4.883 0 0 1-1.153 1.772 4.915 4.915 0 0 1-1.772 1.153c-.637.247-1.363.415-2.428.465-1.066.047-1.405.06-4.122.06-2.717 0-3.056-.01-4.122-.06-1.065-.05-1.79-.218-2.428-.465a4.89 4.89 0 0 1-1.772-1.153 4.904 4.904 0 0 1-1.153-1.772c-.248-.637-.415-1.363-.465-2.428C2.013 15.056 2 14.717 2 12c0-2.717.01-3.056.06-4.122.05-1.066.217-1.79.465-2.428a4.88 4.88 0 0 1 1.153-1.772A4.897 4.897 0 0 1 5.45 2.525c.638-.248 1.362-.415 2.428-.465C8.944 2.013 9.283 2 12 2zm0 5a5 5 0 1 0 0 10 5 5 0 0 0 0-10zm6.5-.25a1.25 1.25 0 0 0-2.5 0 1.25 1.25 0 0 0 2.5 0zM12 9a3 3 0 1 1 0 6 3 3 0 0 1 0-6z"/></svg>
            </a> 
            <a data-scroll target="blank" title="Youtube" href="https://www.youtube.com/channel/UC062UX4caywvYdfneHAw14w">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path fill="#ffffff" d="M21.543 6.498C22 8.28 22 12 22 12s0 3.72-.457 5.502c-.254.985-.997 1.76-1.938 2.022C17.896 20 12 20 12 20s-5.893 0-7.605-.476c-.945-.266-1.687-1.04-1.938-2.022C2 15.72 2 12 2 12s0-3.72.457-5.502c.254-.985.997-1.76 1.938-2.022C6.107 4 12 4 12 4s5.896 0 7.605.476c.945.266 1.687 1.04 1.938 2.022zM10 15.5l6-3.5-6-3.5v7z"/></svg>
            </a> 
            <a data-scroll target="blank" title="Github" href="https://github.com/EzraChai">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path fill="#ffffff" d="M12 2C6.475 2 2 6.475 2 12a9.994 9.994 0 0 0 6.838 9.488c.5.087.687-.213.687-.476 0-.237-.013-1.024-.013-1.862-2.512.463-3.162-.612-3.362-1.175-.113-.288-.6-1.175-1.025-1.413-.35-.187-.85-.65-.013-.662.788-.013 1.35.725 1.538 1.025.9 1.512 2.338 1.087 2.912.825.088-.65.35-1.087.638-1.337-2.225-.25-4.55-1.113-4.55-4.938 0-1.088.387-1.987 1.025-2.688-.1-.25-.45-1.275.1-2.65 0 0 .837-.262 2.75 1.026a9.28 9.28 0 0 1 2.5-.338c.85 0 1.7.112 2.5.337 1.912-1.3 2.75-1.024 2.75-1.024.55 1.375.2 2.4.1 2.65.637.7 1.025 1.587 1.025 2.687 0 3.838-2.337 4.688-4.562 4.938.362.312.675.912.675 1.85 0 1.337-.013 2.412-.013 2.75 0 .262.188.574.688.474A10.016 10.016 0 0 0 22 12c0-5.525-4.475-10-10-10z"/></svg>
            </a>
            <a data-scroll target="blank" title="Linkedin" href="https://www.linkedin.com/in/ezra-chai-juan-zhe-9b8b3a209">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path fill="#ffffff" d="M18.335 18.339H15.67v-4.177c0-.996-.02-2.278-1.39-2.278-1.389 0-1.601 1.084-1.601 2.205v4.25h-2.666V9.75h2.56v1.17h.035c.358-.674 1.228-1.387 2.528-1.387 2.7 0 3.2 1.778 3.2 4.091v4.715zM7.003 8.575a1.546 1.546 0 0 1-1.548-1.549 1.548 1.548 0 1 1 1.547 1.549zm1.336 9.764H5.666V9.75H8.34v8.589zM19.67 3H4.329C3.593 3 3 3.58 3 4.297v15.406C3 20.42 3.594 21 4.328 21h15.338C20.4 21 21 20.42 21 19.703V4.297C21 3.58 20.4 3 19.666 3h.003z"/></svg>
            </a>
            </div>
        </div>
    </footer>
</x-guest-layout>