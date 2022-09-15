<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <script>
            function handleSelectedFile(event){
                let fileText = document.getElementById("fileName");
                fileText.innerHTML = event.target.files[0].name;
            }
        </script>

        <form method="POST" action="/dashboard/competition/{{$competition_id}}/participant/import" enctype="multipart/form-data">
            @csrf
                <div class="mt-4">
                    <div class=" w-full h-100 border border-dashed border-gray-500 relative">
                        <input type="file" name="uploaded_file" accept=".csv" onchange="handleSelectedFile(event)" multiple class="cursor-pointer relative block opacity-0 w-full h-full p-20 z-50">
                            <div class="text-center p-10 absolute top-0 right-0 left-0 m-auto">
                            <h4>
                                Muatnaik fail di sini
                                <br/>atau
                            </h4>
                            <button class="btn btn-secondary">Pilih fail</button>
                            <div id="fileName" class="mt-2"/>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-end mt-4">
                    <x-jet-button class="btn">
                        {{ __('Mendaftar') }}
                    </x-jet-button>
                </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
