<x-app-worker-layout>
    <x-slot name="pageTitle">
        Pravna lica
    </x-slot>
    <x-slot name="header">
    </x-slot>
    <form method="POST" id="form1" action="{{ route('worker.archive.submit.contact.pravna') }}">
        @csrf
        <div class="flex mt-16">
            <div class="flex w-1/2 items-center flex-col">
                @if ($pravna_lica->isNotEmpty())
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
                <div class="flex flex-col w-full" id="pravna_lica">
                    <label for="company" class="text-xl my-3">Naziv firme :</label>
                    <input class="input-style" name="company" type="text" />

                    <label for="grad" class="text-xl my-3">Grad :</label>
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
        <input type="hidden" value="{{ $id }}" name="ponuda_id">
    </form>
</x-app-worker-layout>
