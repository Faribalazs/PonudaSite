<x-app-worker-layout>
    <x-slot name="pageTitle">
        Izaberi kontakt
    </x-slot>
    <x-slot name="header">
    </x-slot>
    <div class="mt-24">
        <a href="{{ route('worker.archive.fizicka_lica', ['ponuda_id' => $ponuda_id]) }}"><button class="mt-3 confirm-btn">Fizicka lica</button></a>
        <a href="{{ route('worker.archive.pravna_lica', ['ponuda_id' => $ponuda_id]) }}"><button class="mt-24 confirm-btn">Pravna lica</button></a>
    </div>
    {{-- <form method="POST" id="form1" action="{{ route('worker.archive.submit.contact') }}">
        @csrf
        <div class="flex w-full mt-24">
            <div class="flex w-1/2 px-3 justify-center">
                <button type="button" id="fizicka_btn" class="finish-btn" onclick="fizickaLica()">Fizicka Lica</button>
            </div>
            <div class="flex w-1/2 px-3 justify-center">
                <button type="button" id="pravna_btn" class="finish-btn" onclick="pravnaLica()"
                    style="background-color: grey;">Pravna Lica</button>
            </div>
        </div>
        <div class="flex mt-16">
            <div class="flex w-1/2 items-center flex-col">
                @if (!empty($fizicka_lica))
                    <select name="selectedFizicko" id="selectedClient">
                        <option value="select" selected disabled>Select one</option>
                        @foreach ($fizicka_lica as $client)
                            <option value="{{ $client->id }}">{{ $client->first_name }} {{ $client->last_name }}
                            </option>
                        @endforeach
                    </select>
                @endif
                @if (!empty($pravna_lica))
                    <select name="selectedPravno" id="selectedClient">
                        <option value="select" selected disabled>Select one</option>
                        @foreach ($pravna_lica as $client)
                            <option value="{{ $client->id }}">{{ $client->company_name }}
                            </option>
                        @endforeach
                    </select>
                @endif
            </div>
            <div class="flex w-1/2 flex-col">
                <div class="flex flex-col w-full" id="fizicka_lica">
                    <label for="f_name" class="text-xl my-3">Ime :</label>
                    <input class="input-style" name="f_name" type="text" />

                    <label for="l_name" class="text-xl my-3">Prezime :</label>
                    <input class="input-style" name="l_name" type="text" />

                    <label for="gard" class="text-xl my-3">Grad :</label>
                    <input class="input-style" name="grad" type="text" />

                    <label for="postcode" class="text-xl my-3">Postanski broj :</label>
                    <input class="input-style" name="postcode" type="text" />

                    <label for="adresa" class="text-xl my-3">Adresa :</label>
                    <input class="input-style" name="adresa" type="text" />

                    <label for="email" class="text-xl my-3">E-mail :</label>
                    <input class="input-style" name="email" type="text" />

                    <label for="tel" class="text-xl my-3">Telefon :</label>
                    <input class="input-style" name="tel" type="text" />

                    <div class="flex items-center">
                        <label for="save" class="text-xl my-3">Sacuvaj klijenta</label>
                        <input type="checkbox" class="ml-3" name="save" value="1" />
                    </div>
                </div>

                <div class="flex flex-col w-full" id="pravna_lica" style="display: none;">
                    <label for="company" class="text-xl my-3">Naziv firme :</label>
                    <input class="input-style" name="company" type="text" />

                    <label for="gard" class="text-xl my-3">Grad :</label>
                    <input class="input-style" name="grad" type="text" />

                    <label for="postcode" class="text-xl my-3">Postanski broj :</label>
                    <input class="input-style" name="postcode" type="text" />

                    <label for="adresa" class="text-xl my-3">Adresa :</label>
                    <input class="input-style" name="adresa" type="text" />

                    <label for="email" class="text-xl my-3">E-mail :</label>
                    <input class="input-style" name="email" type="text" />

                    <label for="tel" class="text-xl my-3">Telefon :</label>
                    <input class="input-style" name="tel" type="text" />

                    <label for="pib" class="text-xl my-3">PIB :</label>
                    <input class="input-style" name="pib" type="text" />

                    <div class="flex items-center">
                        <label for="save" class="text-xl my-3">Sacuvaj klijenta</label>
                        <input type="checkbox" class="ml-3" name="save" value="1" />
                    </div>
                </div>
            </div>
        </div>
        <div class="flex w-full mt-10">
            <button type="submit" class="finish-btn mt-5 text-xl w-full">Nastavi</button>
        </div>
        <input type="hidden" value="{{ $ponuda_id }}" name="ponuda_id">
    </form>
    <script>
        function pravnaLica() {
            var x = document.getElementById("pravna_lica");
            var y = document.getElementById("fizicka_btn");
            var z = document.getElementById("fizicka_lica");
            var a = document.getElementById("pravna_btn");
            if (x.style.display === "none") {
                x.style.display = "flex";
                y.style.backgroundColor = "grey";
                z.style.display = "none";
                a.style.backgroundColor = "#ed5840";
            }
        }

        function fizickaLica() {
            var x = document.getElementById("fizicka_lica");
            var y = document.getElementById("fizicka_btn");
            var a = document.getElementById("pravna_btn");
            var z = document.getElementById("pravna_lica");
            if (x.style.display === "none") {
                x.style.display = "flex";
                a.style.backgroundColor = "grey";
                y.style.backgroundColor = "";
                z.style.display = "none";
            }
        }
    </script> --}}
</x-app-worker-layout>
